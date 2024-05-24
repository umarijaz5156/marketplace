<?php

namespace App\Http\Livewire\Seller\Orders;

use App\Enums\EmailTemplateType;
use Carbon\Carbon;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Models\Order\Order;
use App\Enums\RequestStatus;
use App\Enums\TimelineStatus;
use App\Events\OrderPlaced;
use App\Models\Seller\Seller;
use App\Models\Ticket\Ticket;
use Livewire\WithFileUploads;
use App\Models\ChatCenter\Chat;
use App\Models\Newsletter;
use App\Models\Offer;
use App\Models\Order\OrderRequest;
use App\Models\Order\OrderTimeline;
use App\Models\Order\OrderAttachment;
use App\Models\Seller\GigDetail;
use App\Models\User;
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
    public $days;
    public $minutes;
    public $hours;
    public $openModal;
    public $openModal2;
    public $isLate;
    public $details;
    public $deliveryFiles = [];
    public $fileNames = [];
    public $openExtensionModal;
    public $requestSubject;
    public $requestDays;
    public $modificationDetails;
    public $modifModal;
    public $chat_id;
    public $cancelModal;
    public $cancellationRequest;
    public $isCancellationRequest;
    public $openCancellationAcceptModal;

    protected $listeners = ['refresh' => '$refresh', 'refreshOrder' => '$refresh'];


    protected $rules = [

        'requestSubject' => 'required|max:200',
        'requestDays' => 'required|numeric|min:1|max:99',
    ];

    public function render()
    {
        $this->getOrder($this->orderId);
        $this->authorize('sellerView', $this->order);
        $this->checkChat();
        $this->checkCancellationRequest();
        $this->getReview();
        return view('livewire.seller.orders.details')->layout('components.seller.dashboard-layout');
    }

    public function mount($id)
    {
        $this->orderId = $id;
       $this->openModal = false;
       $this->openModal2 = false;
       $this->toggleExtensionModal = false;
       $this->toggleModifModal = false;
       $this->openCancellationAcceptModal = false;
       $this->cancelModal = false;

    }

    public function download($attachment)
    {
        ini_set("memory_limit","-1");
        return Storage::disk('gigs')->download($attachment);
    }

    public function getTimeRemaining()
    {

        $now = Carbon::now();
        $delivery_date = $this->order->orderDetails->delivery_time;
        $diff = $now->diff($delivery_date);

        $this->days = $diff->d;
        $this->minutes = $diff->i;
        $this->hours = $diff->h;

        // late order
        $this->isLate = $diff->invert;

        if($this->isLate && $this->order->status == OrderStatus::InProgress->value) {
            $this->order->status = OrderStatus::Pending->value;
            $this->order->save();
            $this->emitSelf('refresh');
        }

    }



    public function getOrder($id)
    {
        $this->order = Order::with(['orderDetails','orderAttachments' => function($query){
            $query->latest();
        },'orderReviews','timeline','requests','user' => function($query){
            $query->select('id','name');
        },'gig' => function($query){
            $query->with(['gigImages' => function($query){
                $query->where('image_type', 'M');
            }]);

        }])->where('id', $id)->firstOrFail();

        if($this->order->status == OrderStatus::InProgress->value || $this->order->status == OrderStatus::Pending->value){
            $this->getTimeRemaining();
        }
        $this->getDeliveryFiles();
    }


    public function updatedFiles()
    {

        $this->validate([
            'files.*' => 'mimes:png,jpg,docx,jpeg,doc,pdf,txt,zip|max:5120',
            'files' => 'array|max:3'
        ]);
        $this->getTempFileNames();

    }

    public function deliverOrder()
    {
        $this->validate([

            'files.*' => 'mimes:png,jpg,docx,jpeg,doc,pdf,txt,zip|max:5120',
            'files' => 'array|max:3'
        ]);


        $this->order->status = OrderStatus::Delivered->value;
        $this->order->save();

        $timeline = OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' => TimelineStatus::Delivered,
            'modifications' => $this->details,
            'request_by' => 'seller'
        ]);
        $this->saveFiles($timeline->id);

        $this->toggleModal();
        $this->reset('details');
        session()->flash('message','Order delivered sucessfully');

        // send notification to buyer
        // $this->order->buyer->setConnection('mysql');
        $buyer = User::find($this->order->buyer->id);
        // $buyer->setConnection('mysql');
        $buyer->notify(new OrderUpdated($this->order, OrderStatus::Delivered));

         // send order delivered email to user
         $message = 'Someone just delivered the service ';
        //  broadcast(new OrderPlaced($this->order, $message));
         $this->sendOrderMail($this->order);

    }

    public function getTempFileNames()
    {
        if(count($this->files) > 0){
            foreach($this->files as $file){
                array_push($this->fileNames,  $file->getClientOriginalName());
            }
        }
    }

    public function saveFiles($id)
    {

        if(count($this->files) > 0)
        {
            $seller =  Seller::where('user_id', auth()->user()->id)->first('seller_name');

            foreach($this->files as $file){

                $path =  $file->storeAs('delivery', $file->getClientOriginalName(), 'gigs');
                $attachment = new OrderAttachment([
                     'attachment_path' => $path,
                     'added_by' => $seller->seller_name,
                     'is_delivery' => true,
                     'details' => $this->details,
                     'timeline_id' => $id
                ]);
                $this->order->orderAttachments()->save($attachment);
             }
             $this->order->has_attachments = true;
             $this->order->save();

        }

    }


    public function getDeliveryFiles()
    {
        $this->deliveryFiles = $this->order->orderAttachments->where('is_delivery', true);

    }

    public function sendRequest()
    {
        $this->validateOnly('requestSubject');
        $this->validateOnly('requestDays');
        $timeline = OrderTimeline::create([
            'status' => 'Requested Extension',
            'order_id' => $this->order->id,
            'request_by' => 'seller'
        ]);
        OrderRequest::create([
            'order_id' => $this->order->id,
            'subject' => $this->requestSubject,
            'days' => $this->requestDays,
            'status' => OrderStatus::Pending->value,
            'timeline_id' => $timeline->id,
        ]);
        $this->toggleExtensionModal();
        $message = "Seller has requested deadline extension for order #".$this->order->id;
        $this->order->buyer->notify(new OrderUpdated($this->order, OrderStatus::InProgress, $message));
        session()->flash('message' , 'Request Sent Successfully');
        // $this->emitSelf('refresh');
    }

    public function showModifDetails($details)
    {

        $this->toggleModifModal();
        $this->modificationDetails = $details;
    }

    public function checkCancellationRequest()
    {
        $requests = $this->order->requests()->where('type', 'Cancellation')->latest()->limit(1)->get();
        if(count($requests) > 0)
        {
            if($requests->first()->status == 'Pending'){
                $this->isCancellationRequest= true;

            } else{
                $this->isCancellationRequest= false;
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
            'request_by' => 'seller'
        ]);
        $this->toggleCancelationAcceptModal();
        // session()->flash('message' , 'Request Accepted Successfully');
    }

    public function abortCancellationRequest()
    {

        $this->cancellationRequest->status = RequestStatus::Rejected->value;
        $this->cancellationRequest->save();
        OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' => 'Cancel Request Rejected',
            'request_by' => 'seller'
        ]);
        session()->flash('message' , 'Request Rejected Successfully');

    }


    // toggle modals
    public function toggleModal()
    {
        $this->openModal = !$this->openModal;
    }

    public function toggleModal2()
    {
        $this->openModal2 = !$this->openModal2;
    }

    public function toggleExtensionModal()
    {
        $this->openExtensionModal = !$this->openExtensionModal;
        $this->reset(['requestDays', 'requestSubject']);
    }

    public function redirectDispute()
    {
        $ticket = Ticket::where('order_id', $this->order->id)->first('id');
        if($ticket){
            return redirect(route('seller.dispute-details', ['id' => $ticket->id]));
        }
        return redirect(route('seller_disputes'));
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
        return redirect(route('seller.message_details' , ['id' => $this->chat_id]));
    }

    // cancel order request
    public function cancelOrder()
    {
        $timeline = OrderTimeline::create([
            'order_id' => $this->order->id,
            'status' => 'Cancel Request',
            'request_by' => 'seller'
        ]);
        OrderRequest::create([
            'type' => 'Cancellation',
            'subject' => 'Seller',
            'order_id' => $this->order->id,
            'status' => 'Pending',
            'timeline_id' => $timeline->id
        ]);

        $this->toggleCancelModal();
        session()->flash('message','Request sent sucessfully');

    }

    public function checkRequest(){
       return $this->order->timeline->where('status', 'Requested Modifcations')->count();
    }



    public function sendOrderMail($order)
    {
        // send order delivered mail to buyer
        if($buyerMailData = Newsletter::where('type', EmailTemplateType::OrderDeliveredBuyer->value)->first()) {
            $subject =  $buyerMailData->subject;

            // email send to buyer
            $buyer_data = $this->sellerBuyerMailData($buyerMailData, $order, 'byyer');

            $buyer_mail_data = ['body' => $buyer_data['body'], 'subject' => $subject];
            $url = route('buyerorder_details', ['id' => $order->id]);
            dispatch(new \App\Jobs\SendOrderMailJob($buyer_mail_data, $buyer_data['to'], $url));
        }

        if($sellerMailData = Newsletter::where('type', EmailTemplateType::OrderDeliveredSeller->value)->first()){
            $subject =  $sellerMailData->subject;
            // email send to seller
            $seller_data = $this->sellerBuyerMailData($sellerMailData, $order, 'seller');

            $seller_mail_data = ['body' => $seller_data['body'] ,'subject' => $subject];
            $url = route('order_details', ['id' => $order->id]);
            dispatch(new \App\Jobs\SendOrderMailJob($seller_mail_data, $seller_data['to'], $url));
        }
    }

    public function sellerBuyerMailData($mailData, $order, $user_type)
    {
        $order = $order->load('user');

        $body = str_replace('{{order_id}}', $order->id, $mailData->body);
        if($order->type == 'normal'){
            $body = str_replace('{{service}}', GigDetail::where('gig_id', $order->gig_id)->first()->title, $body, $body);
        } else{
            $body = str_replace('{{service}}', Offer::find($order->offer_id)->title, $body, $body);
        }



        if($user_type == 'seller'){
            $body = str_replace('{{order_amount}}', $order->load('orderDetails')->orderDetails->total, $body);
            $body = str_replace('{{seller}}', auth()->user()->name, $body);

            $to = auth()->user()->email;
        } else {
            $body = str_replace('{{order_amount}}', $order->load('orderDetails')->orderDetails->amount, $body);
            $body = str_replace('{{user}}', $order->user->name, $body);

            $to = $order->user->email;
        }

        return ['body' => $body, 'to' => $to];
    }

     public function getReview()
    {
        $review = $this->order->orderReviews->where('review_type', 'buyer')->first();
        if($review){
            $this->rating = $review->rating;
        }

    }
}
