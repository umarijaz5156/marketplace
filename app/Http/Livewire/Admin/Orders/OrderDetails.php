<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Enums\EmailTemplateType;
use App\Enums\OrderStatus;
use App\Enums\RequestStatus;
use App\Enums\TimelineStatus;
use App\Jobs\SendOrderMailJob;
use App\Models\Newsletter;
use App\Models\Order\Order;
use App\Models\Order\OrderAttachment;
use App\Models\Order\OrderTimeline;
use App\Models\Seller\GigDetail;
use App\Models\Seller\GigStat;
use App\Models\Seller\Seller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class OrderDetails extends Component
{
    use WithFileUploads;

    public $order;
    public $files = [];
    public $fileNames = [];
    public $details;
    public $openModal = false;
    public $openModal3 = false;
    public $openModal4 = false;
    public $cancelModal = false;
    public $modifModal = false;
    public $isCancellationRequest;
    public $cancellationRequest;
    public $rejectModal;
    public $openCancellationAcceptModal;
    public $modificationFile;
    public $modificationDetails;
    public $viewModificationDetails;

    // listeners
    protected $listeners = ['refreshOrder' => '$refresh'];

    protected $rules = [
        'files' => 'required',
        'details' => 'required',
        // 'requestSubject' => 'required|max:200',
        // 'requestDays' => 'required|numeric|min:1|max:99',
        'modificationDetails' => 'required'
    ];

    public function updatedModificationDetails()
    {
        $this->validateOnly('modificationDetails');
    }

    // toggle modals
    public function toggleModal()
    {
        $this->openModal = !$this->openModal;
    }

    public function toggleModal3()
    {
        $this->openModal3 = !$this->openModal3;
    }

    public function toggleModal4()
    {
        
        $this->openModal4 = !$this->openModal4;
    }

    public function toggleRejectModal()
    {
        $this->rejectModal = !$this->rejectModal;
    }

    // toggle cancel modal
    public function toggleCancelModal()
    {
        $this->cancelModal = !$this->cancelModal;
    }

    public function toggleModifModal()
    {
        $this->modifModal = !$this->modifModal;
    }

    // cancel order
    public function cancelOrder()
    {
        $this->dispatchBrowserEvent('order_cancelled', ['id' => $this->order->id]);
        // $this->order->status = OrderStatus::Cancelled->value;
        // $this->order->save();


        if($this->isCancellationRequest) {
            $this->cancellationRequest->status = RequestStatus::Accepted->value;
            $this->cancellationRequest->save();
        }

        $this->toggleCancelModal();
        session()->flash('success' , 'Order has been cancelled successfully');
    }

    // reject order cancellation request
    public function abortCancellationRequest()
    {
        $this->cancellationRequest->status = RequestStatus::Rejected->value;
        $this->cancellationRequest->save();

        $this->toggleRejectModal();
        session()->flash('success' , 'Request Rejected Successfully');
    }

    // deliver order
    public function deliverOrder()
    {
        $this->validate([
            'details' => 'required',
        ]);

        $this->saveFiles();
        $this->order->status = OrderStatus::Delivered->value;
        $this->order->save();


        $this->toggleModal();
        session()->flash('success','Order delivered sucessfully');

    }

    // accept order
    public function acceptOrder()
    {
         // add order timeline
        OrderTimeline::create([
            'order_id' => $this->order->id,
            'request_by' => 'admin',
            'status' =>  OrderStatus::Completed->value
        ]);
        $this->dispatchBrowserEvent('order_completed', ['id' => $this->order->id]);
        $this->toggleModal3();

        // send order completed email to user
        $this->sendOrderMail($this->order);

    }

    public function sendModifications()
    {
        $this->validateOnly('modificationDetails');
        $path = null;
        if($this->modificationFile){
            $path =  $this->modificationFile->storeAs('requirements', $this->modificationFile->getClientOriginalName(), 'gigs');
        }
        OrderTimeline::create([
            'order_id' => $this->order->id,
            'request_by' => 'admin',
            'status' => TimelineStatus::RequestedModifcations,
            'modifications' => $this->modificationDetails,
            'file_path' => $path
        ]);
        $this->order->status = OrderStatus::InProgress->value;
        $this->order->save();

        // send modification email
        if($mailData = Newsletter::where('type', EmailTemplateType::OrderModificationRequest->value)->first()){
            $body = $mailData->body;

            $body = str_replace("{{seller}}", $this->order->seller->seller_name, $body);
            $body = str_replace("{{user}}", $this->order->user->name, $body);
            $body = str_replace("{{service}}", GigDetail::where('gig_id', $this->order->gig_id)->first()->title, $body);
            $body = str_replace("{{order_amount}}", $this->order->orderDetails->total, $body);

            $data = ['body' => $body, 'subject' => $mailData->subject];

            $user_id = $this->order->seller->user_id;
            if($user = User::find($user_id)){
                $mail_to = $user->email;

                dispatch(new SendOrderMailJob($data, $mail_to));
            }

        }

        session()->flash('message' , 'Modifications Requested successfully');
        $this->toggleModal4();
        $this->reset('modificationDetails');
    }

    public function saveFiles()
    {

        if(count($this->files) > 0)
        {
            $seller =  $this->order->load('seller')->seller;

            foreach($this->files as $file){

                $path =  $file->storeAs('delivery', $file->getClientOriginalName(), 'gigs');

                $attachment = new OrderAttachment([
                     'attachment_path' => $path,
                     'added_by' => $seller->seller_name,
                     'is_delivery' => true,
                     'details' => $this->details
                ]);

                $this->order->orderAttachments()->save($attachment);
             }
             $this->order->has_attachments = true;
             $this->order->save();

        }

    }

    public function download($attachment)
    {
        ini_set("memory_limit","-1");
        return Storage::disk('gigs')->download($attachment);
    }

    public function checkCancellationRequest()
    {
        $requests = $this->order->requests()->where('type', 'Cancellation')->latest()->limit(1)->get();
        if(count($requests) > 0)
        {
            if($requests->first()->status == 'Pending'){
                $this->isCancellationRequest= true;
            } else {
                $this->isCancellationRequest= false;
            }
            $this->cancellationRequest = $requests->first();
        }

    }

    public function showModifDetails($details)
    {
        $this->toggleModifModal();
        $this->viewModificationDetails = $details;
    }

    // Send email functions
    public function sendOrderMail($order)
    {
        // send email to user
        if($mailData = Newsletter::where('type', EmailTemplateType::OrderCompletedBuyer->value)->first())
        {
            $logo = asset('/images/basics/pushi_logo.png');
            $subject = $mailData->subject;

            // send email to buyer
            $buyer_data = $this->sellerBuyerMailData($mailData, $order, 'buyer');

            $buyer_mail_data = ['body' => $buyer_data['body'], 'subject' => $subject, 'logo' => $logo];

            dispatch(new SendOrderMailJob($buyer_mail_data, $buyer_data['to']));
        }

        // send email to seller
        if($sellerMailData = Newsletter::where('type', EmailTemplateType::OrderCompletedSeller->value)->first()){
            // send email to seller
            $seller_data = $this->sellerBuyerMailData($sellerMailData, $order, 'seller');
            $seller_mail_data = ['subject' => $sellerMailData->subject, 'body' => $seller_data['body']];

            dispatch(new SendOrderMailJob($seller_mail_data, $seller_data['to']));
        }
    }

    public function sellerBuyerMailData($mailData, $order, $user_type)
    {
        $order = $order->load('seller');

        $seller_id = $order->seller->id;
        $seller = Seller::find($seller_id);
        $seller_email = User::find($seller->user_id)->email;

        $body = str_replace('{{order_id}}', $order->id, $mailData->body);
        $body = str_replace('{{service}}', GigDetail::find($order->gig_id)->title, $body);

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

    public function render()
    {
        $this->checkCancellationRequest();

        $orderDetail = Order::with(['gig'=>function($query){
                                $query->with(['gigImages' => function($query){
                                    $query->where('image_type', 'M');
                                }]);
                            }, 'orderDetails', 'orderReviews', 'timeline', 'orderAttachments', 'user', 'seller'])
                            ->where('orders.id',$this->order->id)
                            ->first();
        return view('livewire.admin.orders.order-details', [
            'orderDetail' => $orderDetail
        ]);
    }
}
