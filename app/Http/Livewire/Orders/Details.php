<?php

namespace App\Http\Livewire\Orders;

use App\Enums\EmailTemplateType;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\Enums\RequestStatus;
use App\Enums\TimelineStatus;
use App\Jobs\SendOrderMailJob;
use App\Models\ChatCenter\Chat;
use App\Models\MiscConfig;
use App\Models\Newsletter;
use App\Models\Offer;
use Livewire\WithFileUploads;
use App\Models\Order\OrderDetail;
use App\Models\Order\OrderRequest;
use App\Models\Order\OrderTimeline;
use App\Models\Order\OrderAttachment;
use App\Models\Seller\GigDetail;
use App\Models\Seller\Seller;
use App\Models\Ticket\Ticket;
use App\Notifications\OrderUpdated;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class Details extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $order;
    public $orderId;
    public $files = [];
    public $openModal;
    public $openModal2;
    public $openModal3;
    public $openModal4;
    public $fileNames = [];
    public $isLate;
    public $days;
    public $minutes;
    public $hours;
    public $deliveryFiles = [];
    public $details;
    public $modificationFile;
    public $modificationDetails;
    public $modifModal;
    public $chat_id;
    public $ticket_id;
    public $cancellationRequest;
    public $isCancellationRequest;
    public $openCancellationAcceptModal;
    public $cancelModal;
    public $rating;
    public $noOfRevisionsLeft;

    protected $listeners = ['refreshOrder', 'refresh' => '$refresh'];

    protected $rules = [
        'modificationDetails' => 'required'
    ];

    public function refreshOrder(){
        return redirect()->route('buyerorder_details', ['id' => $this->orderId]);
    }

    public function render()
    {

        $this->getOrder($this->orderId);
        $this->authorize('userView', $this->order);

        $this->checkChat();
        $this->checkTicket();
        $this->checkCancellationRequest();
        $this->getReview();
        return view('livewire.orders.details');
    }

    public function mount($id)
    {
        $this->orderId = $id;
        $this->openModal = false;
        $this->openModal2 = false;
        $this->openCancellationAcceptModal = false;
        $this->cancelModal = false;
        $totalRevisions = MiscConfig::where('name', 'revisions')->first()?->value;
        if($totalRevisions){
            $revisionsSent = OrderTimeline::where('order_id', $id)->where('status', TimelineStatus::RequestedModifcations)->count();
            $this->noOfRevisionsLeft = $totalRevisions - $revisionsSent;

        }

    }

    public function getOrder($id)
    {
        $this->order = Order::with(['orderDetails', 'orderReviews','timeline','orderAttachments' => function ($query) {
            $query->latest();
        }, 'requests' , 'seller' => function ($query) {

            $query->select('id', 'seller_name');
        }, 'gig' => function ($query) {
            $query->with(['gigImages' => function ($query) {
                $query->where('image_type', 'M');
            }]);
        }])->findOrFail($id);

        if ($this->order->status == OrderStatus::InProgress->value || $this->order->status == OrderStatus::Pending->value) {
            $this->getTimeRemaining();
        }
        $this->getDeliveryFiles();

    }

    public function getTimeRemaining()
    {
        $now = Carbon::now();
        $delivery_date = $this->order->orderDetails->delivery_time;
        $diff = $now->diff($delivery_date);
        $this->days = $diff->d;
        $this->minutes = $diff->i;
        $this->hours = $diff->h;
        $this->isLate = $diff->invert;

        if ($this->isLate && $this->order->status == OrderStatus::InProgress->value) {
            $this->order->status = OrderStatus::Pending->value;
            $this->order->save();
            $this->emitSelf('refresh');
        }
    }


    public function acceptOrder()
    {
         // add order timeline
        OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' =>  OrderStatus::Completed->value,
            'request_by' => 'buyer'
        ]);
        $this->dispatchBrowserEvent('order_completed', ['id' => $this->order->id]);
        $this->toggleModal3();

        // send order completed email to user
        $this->sendOrderMail($this->order);

    }

    public function updatedFiles()
    {
        $this->getTempFileNames();
    }

    public function getTempFileNames()
    {
        if (count($this->files) > 0) {
            foreach ($this->files as $file) {
                array_push($this->fileNames,  $file->getClientOriginalName());
            }
        }
        return $this->fileNames;
    }

    public function saveFiles()
    {
        if (count($this->files) > 0) {
            $user = User::where('id', auth()->user()->id)->first('name');
            foreach ($this->files as $file) {

                $path =  $file->storeAs('requirements', $file->getClientOriginalName(), 'gigs');
                $attachment = new OrderAttachment([
                    'attachment_path' => $path,
                    'added_by' => $user->name,
                    'is_delivery' => false,

                ]);
                $this->order->orderAttachments()->save($attachment);
            }
            $this->order->has_attachments = true;
            $this->order->save();
            $this->toggleModal();
            $this->emitSelf('refresh');
        }
    }

    public function download($attachment)
    {
        ini_set("memory_limit","-1");
        return Storage::disk('gigs')->download($attachment);
    }

    public function getDeliveryFiles()
    {
        $this->deliveryFiles = $this->order->orderAttachments?->where('is_delivery', true);
    }

    public function acceptRequest($id)
    {
        $request = OrderRequest::find($id);
        $request->status = RequestStatus::Accepted->value;
        $request->save();

        $orderDetails = OrderDetail::where('order_id', $this->order->id)->first();

        $orderDetails->delivery_time =   $orderDetails->delivery_time->addDays($request->days);

        $orderDetails->save();

        if($orderDetails->delivery_time->gt(Carbon::now())){
            $this->order->status = OrderStatus::InProgress->value;
            $this->order->save();
        }
        $message = "Request for extension of deadline accepted for order #".$this->order->id;
        $this->order->seller->notify(new OrderUpdated($this->order, OrderStatus::InProgress, $message ));
        session()->flash('message' , 'Request Accepted Successfully');
    }

    public function rejectRequest($id)
    {
        $request = OrderRequest::find($id);
        $request->status = RequestStatus::Rejected->value;
        $request->save();
        $message = "Request for extension of deadline rejected  for order #".$this->order->id;
        $this->order->seller->notify(new OrderUpdated($this->order, OrderStatus::InProgress, $message ));
        session()->flash('message' , 'Request Rejected Successfully');
    }

    public function checkTicket()
    {
        $ticket = Ticket::where('order_id',$this->order->id)->first('id');
        if($ticket)
        {
            $this->ticket_id = $ticket->id;
        }

    }

    public function redirectDispute()
    {
        if($this->ticket_id){
            return redirect(route('dispute_details' , ['id' => $this->ticket_id]));
        }
        return redirect(route('disputes'));
    }

    public function sendModifications()
    {
        // $this->validateOnly('modificationDetails');
        $this->validate([
            'modificationDetails' => 'required',
            'modificationFile' =>  ['mimes:png,doc,docx,jpg,jpeg,pdf,txt,zip', 'max:5120'],
        ]);
        $path = null;
        if($this->modificationFile){
            $path =  $this->modificationFile->storeAs('requirements', $this->modificationFile->getClientOriginalName(), 'gigs');
        }
        OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' => TimelineStatus::RequestedModifcations,
            'modifications' => $this->modificationDetails,
            'file_path' => $path,
            'request_by' => 'buyer'
        ]);
        $this->order->status = OrderStatus::InProgress->value;
        $this->order->save();
        session()->flash('message' , 'Modifications Requested successfully');
        $this->toggleModal4();
        $this->modificationDetails ='';
        // send modif notifications
        $message = "Buyer requested modifications for order #".$this->order->id;
        $this->order->seller->notify(new OrderUpdated($this->order, OrderStatus::InProgress, $message));
        // send modification email
        if($mailData = Newsletter::where('type', EmailTemplateType::OrderModificationRequest->value)->first()){
            $body = $mailData->body;

            $body = str_replace("{{seller}}", $this->order->seller->seller_name, $body);
            $body = str_replace("{{user}}", $this->order->user->name, $body);
            if($this->order->type == 'normal'){
                $body = str_replace('{{service}}', GigDetail::where('gig_id', $this->order->gig_id)->first()->title, $body, $body);
            } else{
                $body = str_replace('{{service}}', Offer::find($this->order->offer_id)->title, $body, $body);
            }

            $body = str_replace("{{order_id}}", $this->order->id, $body);

            $data = ['body' => $body, 'subject' => $mailData->subject];

            $user_id = $this->order->seller->user_id;
            $url = route('order_details', ['id' => $this->order->id]);
            if($user = User::find($user_id)){
                $mail_to = $user->email;

                dispatch(new SendOrderMailJob($data, $mail_to, $url));
            }

        }


    }

    public function checkChat()
    {
        $chat = Chat::where('content_id', $this->order->id)->where('content_type','Order')->first('id');
        if($chat){
            $this->chat_id = $chat->id;
        }
    }

    public function redirectChat()
    {
        return redirect(route('messages', ['id' => $this->chat_id]));
    }

    public function checkCancellationRequest()
    {
        $requests = $this->order->requests()->where('type', 'Cancellation')->latest()->limit(1)->get();
        if(count($requests) > 0)
        {
            if($requests->first()->status == 'Pending'){
                $this->isCancellationRequest= true;

            }
            $this->cancellationRequest = $requests->first();
        }
    }

    public function acceptCancellationRequest()
    {
        $this->dispatchBrowserEvent('order_cancelled', ['id' => $this->order->id]);

        $this->cancellationRequest->status = RequestStatus::Accepted->value;
        $this->cancellationRequest->save();
        OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' => 'Cancel Request Accepted',
            'request_by' => 'buyer'
        ]);
        $this->toggleCancelationAcceptModal();
        // session()->flash('message' , 'Request Accepted Successfully');
    }

    public function abortCancellationRequest()
    {
        $this->cancellationRequest->status = RequestStatus::Rejected->value;
        $this->cancellationRequest->save();
         $this->isCancellationRequest= false;
         OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' => 'Cancel Request Rejected',
            'request_by' => 'buyer'
        ]);
        session()->flash('message' , 'Request Rejected Successfully');
    }

     // cancel order request
     public function cancelOrder()
     {
        $timeline =OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' => 'Cancel Request',
            'request_by' => 'buyer'
        ]);

         OrderRequest::create([
             'type' => 'Cancellation',
             'subject' => 'Buyer',
             'order_id' => $this->order->id,
             'status' => 'Pending',
             'timeline_id' => $timeline->id
         ]);

         $this->toggleCancelModal();
         session()->flash('message','Request sent sucessfully');
     }


    public function toggleModal()
    {
        $this->openModal = !$this->openModal;
    }

    public function showFileDetails($details)
    {

        $this->toggleModal2();
        $this->details = $details;
    }

    public function showModifDetails($details)
    {
        $this->toggleModifModal();
        $this->modificationDetails = $details;
    }

    public function toggleModal2()
    {
        $this->openModal2 = !$this->openModal2;
    }

    public function toggleModal3()
    {
        $this->openModal3 = !$this->openModal3;
    }

    public function toggleModal4()
    {

        if(isset($this->noOfRevisionsLeft) &&  $this->noOfRevisionsLeft < 1){
            session()->flash('error', 'Your modifications request exceeds the limit');
            return false;
        }
        $this->openModal4 = !$this->openModal4;
        $this->reset(['modificationDetails', 'modificationFile']);
    }

    public function toggleModifModal()
    {
        $this->modifModal = !$this->modifModal;
    }

    public function toggleCancelationAcceptModal()
    {

        $this->openCancellationAcceptModal = !$this->openCancellationAcceptModal;
    }

    public function toggleCancelModal()
    {
        $this->cancelModal = !$this->cancelModal;
        if(!$this->cancelModal){
            // $this->emitSelf('refreshOrder');
        }
    }

    public function sendOrderMail($order)
    {
        // send email to user
        if($mailData = Newsletter::where('type', EmailTemplateType::OrderCompletedBuyer->value)->first())
        {
            $subject = $mailData->subject;

            // send email to buyer
            $buyer_data = $this->sellerBuyerMailData($mailData, $order, 'buyer');

            $buyer_mail_data = ['body' => $buyer_data['body'], 'subject' => $subject];
            $url = route('buyerorder_details', ['id' => $order->id]);
            dispatch(new \App\Jobs\SendOrderMailJob($buyer_mail_data, $buyer_data['to'], $url));
        }

        // send email to seller
        if($sellerMailData = Newsletter::where('type', EmailTemplateType::OrderCompletedSeller->value)->first()){
            // send email to seller
            $seller_data = $this->sellerBuyerMailData($sellerMailData, $order, 'seller');
            $seller_mail_data = ['subject' => $sellerMailData->subject, 'body' => $seller_data['body']];
            $url = route('order_details', ['id' => $order->id]);
            dispatch(new \App\Jobs\SendOrderMailJob($seller_mail_data, $seller_data['to'], $url));
        }
    }

    public function sellerBuyerMailData($mailData, $order, $user_type)
    {
        $order = $order->load('seller');

        $seller_id = $order->seller->id;
        $seller = Seller::find($seller_id);
        $seller_email = User::find($seller->user_id)->email;

        $body = str_replace('{{order_id}}', $order->id, $mailData->body);
        if($order->type == 'normal'){
            $body = str_replace('{{service}}', GigDetail::where('gig_id', $order->gig_id)->first()->title, $body, $body);
        } else{
            $body = str_replace('{{service}}', Offer::find($order->offer_id)->title, $body, $body);
        }


        if($user_type == 'seller'){
            $body = str_replace('{{order_amount}}', $order->load('orderDetails')->orderDetails->total, $body);
            $body = str_replace('{{seller}}', $seller->seller_name, $body);

            $to = $seller_email;
        } else {
            $body = str_replace('{{order_amount}}', $order->load('orderDetails')->orderDetails->amount, $body);
            $body = str_replace('{{user}}', auth()->user()->name, $body);

            $to = auth()->user()->email;
        }

        return ['body' => $body, 'to' => $to];
    }

    public function getReview()
    {
        $review = $this->order->orderReviews->where('review_type', 'seller')->first();
        if($review){
            $this->rating = $review->rating;
        }

    }
}
