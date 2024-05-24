<?php

namespace App\Http\Livewire\Orders;

use App\Enums\EmailTemplateType;
use App\Events\OrderPlaced;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Events\MessageNotif;
use App\Mail\Order\OrderMail;
use App\Models\Order\Order;
use Livewire\WithFileUploads;
use App\Models\ChatCenter\Chat;
use App\Models\Newsletter;
use App\Models\Order\OrderDetail;
use App\Models\Order\OrderAttachment;
use App\Models\Seller\GigDetail;
use App\Models\Seller\Seller;
use App\Models\Seller\SellerStat;
use App\Models\Setting\RevenueConfiguration;
use App\Stripe\PaymentIntent;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CreateOrder extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $gig;
    public $requirements;
    public $price;
    public $package;
    public $openModal;
    public $requirementAnswer = [];
    public $files = [];
    public $isRequirements;
    public $COMMISSION;
    public $class;
    public $title = "Order Now";

    protected $rules = [
        'files' => ['array', 'max:5'],
        'files.*' =>  ['mimes:png,doc,docx,jpg,jpeg,pdf,txt,zip', 'max:5120'],
        'requirementAnswer.*' => 'required_if:isRequirements,1',
    ];

    public function render()
    {
        return view('livewire.orders.create-order');
    }


    public function mount()
    {
        $this->openModal = false;
        $this->requirements = $this->gig->gigRequirements;
        $this->COMMISSION = RevenueConfiguration::where('id', 1)->first('revenue_commision')->revenue_commision;
        if(count($this->requirements) > 0){
            $this->isRequirements = true;
        } else{
            $this->isRequirements = false;
        }
    }

    public function showModal()
    {
        $this->openModal = !$this->openModal;
    }

    public function order()
    {

        $this->authorize('create', Order::class);


        $this->validate();

        $order = Order::create([
            'gig_id' => $this->gig->id,
            'user_id' => auth()->user()->id,
            'seller_id' => $this->gig->seller_id,
            'has_attachments' => isset($this->files),
            'status' => OrderStatus::UnPaid->value
        ]);

        $deliveryTime = Carbon::now()->addDays($this->package->delivery_days);

        // calculate commision
        $commission = ($this->package->price/100) * $this->COMMISSION;
        $details  = new OrderDetail([
            'amount' => $this->package->price,
            'total' => $this->package->price - $commission,
            'commission' => $commission,
            'gig_package_id' => $this->package->id,
            'delivery_time' => $deliveryTime,
            'buyer_requirements' => $this->requirementAnswer,
        ]);

        $order->orderDetails()->save($details);

        if(isset($this->files)){
            $user = User::where('id', auth()->user()->id)->first('name');
            foreach($this->files as $file){
              
               $path =  $file->storeAs('requirements', $file->getClientOriginalName(), 'gigs');
               $attachment = new OrderAttachment([
                    'attachment_path' => $path,
                    'added_by' => $user->name,
               ]);
               $order->orderAttachments()->save($attachment);
            }
            $order->has_attachments = true;
            $order->save();

        }


        // broadcast(new MessageNotif(auth()->user(), $order->seller->user));
        return redirect(route('order.checkout', ['order' => $order]));

    }
}
