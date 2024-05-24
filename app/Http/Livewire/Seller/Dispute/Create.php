<?php

namespace App\Http\Livewire\Seller\Dispute;

use App\Models\User;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Jobs\SendEmailJob;
use App\Models\Newsletter;
use App\Models\TicketChat;
use App\Models\Seller\Seller;
use App\Models\Ticket\Ticket;
use App\Enums\EmailTemplateType;
use App\Models\Seller\GigDetail;
use App\Models\Order\OrderTimeline;
use App\Notifications\OrderUpdated;

class Create extends Component
{

    public $openModal;
    public $subject;
    public $details;
    public $order;
    public $managerId;


    protected $rules = [
        'details' => 'required',
        'subject' => 'required',
    ];

    public function render()
    {

        return view('livewire.seller.dispute.create');
    }

    public function mount()
    {
        $this->openModal = false;
    }

    public function toggleModal()
    {
        $this->openModal = !$this->openModal;
    }

    public function createTicket()
    {
        if($this->order->status != OrderStatus::Disputed->value) {
            $this->validate();

            $managers = User::with('tickets')->where('is_ticket_manager', true)->get();

            if(count($managers) > 0)
            {
                $this->managerId = $managers->first()->id;
                $minTickets = count(Ticket::where('ticket_manager_id', $managers->first()->id)->get());

                if(count($managers) == 1){
                    $this->managerId = $this->managerId;
                }
                elseif(count($managers) > 1){
                    foreach($managers as $manager){
                        $tickets = count($manager->tickets);
                        if($tickets < $minTickets){
                            $this->managerId = $manager->id;
                            $minTickets = $tickets;
                        }

                    }
                }
            }
            $seller = Seller::where('id',$this->order->seller_id)->first('user_id');
            $ticket = Ticket::create([
                'order_id' => $this->order->id,
                'seller_id' => $seller->user_id,
                'buyer_id' => $this->order->user_id,
                'ticket_manager_id' => $this->managerId,
                'subject' =>$this->subject,
                'created_by' => auth()->user()->id
            ]);

            TicketChat::create([
                    'ticket_id' => $ticket->id,
                    'message' => $this->details,
                    'sender_id' => auth()->user()->id,

                ]);

            $this->order->status = OrderStatus::Disputed->value;
            $this->order->save();
            // send notificaiton to buyer
            $this->order->buyer->notify(new OrderUpdated($this->order, OrderStatus::Disputed));
            OrderTimeline::create([
                'request_by' => 'seller',
                'status' => OrderStatus::Disputed->value,
                'order_id' => $this->order->id
            ]);
            // send mail on dispute start
            $this->sendMailOnDisputeStart($ticket);

            return redirect(route('seller.dispute-details', ['id' => $ticket->id]));
        }
    }

    public function sendMailOnDisputeStart($ticket)
    {
        if($mailData = Newsletter::where('type', EmailTemplateType::DisputeStarted->value)->first()) {
            $subject = $mailData['subject'];
            $order = $ticket->order;

            $body = str_replace('{{order_id}}', $order->id, $mailData->body);
            $body = str_replace('{{service}}', GigDetail::where('gig_id', $order->gig_id)->first()->title, $body);

            $body = str_replace('{{seller}}', $order->seller->seller_name, $body);

            $body = str_replace('{{order_amount}}', $order->orderDetails->amount, $body);
            $body = str_replace('{{user}}', $ticket->buyer->name, $body);

            $to = $order->user->email;

            $data = ['body' => $body, 'subject' => $subject];

            $url = route('dispute_details', ['id' => $ticket->id]);
            dispatch(new SendEmailJob($data, $to, $url));

            $url = route('admin.ticket_chat', ['ticketId' => $ticket->id]);
            $manager = $ticket->manager->email;
            dispatch(new SendEmailJob($data, $manager, $url));
        }
    }
}
