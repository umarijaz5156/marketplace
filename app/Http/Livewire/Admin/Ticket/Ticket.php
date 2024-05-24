<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Enums\EmailTemplateType;
use App\Enums\OrderStatus;
use App\Enums\TicketStatus;
use App\Jobs\SendEmailJob;
use App\Models\ChatCenter\Chat;
use App\Models\Newsletter;
use App\Models\Order\Order;
use App\Models\Seller\GigDetail;
use App\Models\Ticket\Ticket as TicketTicket;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\WithPagination;

class Ticket extends Component
{
    use WithPagination, AuthorizesRequests;

    public $updateStatusId;
    public $search;
    public $statusFilter;
    public $status;
    public $manager_id;
    public $chat;
    public $message;
    public $ticketChatModal = false;
    public $changeStatusModal = false;

    protected $listeners = ['revertStatus', 'refresh' => '$refresh'];
    public function rules()
    {
        return [
            'status' => ['required', new Enum(TicketStatus::class)],
        ];
    }

    public function updatedStatus()
    {
        $this->validateOnly('status');
    }

    public function closeModal($modal)
    {
        $this->$modal = false;
    }

    public function changeStatusId($id)
    {
        $this->status = TicketTicket::find($id)->ticket_winner;
        $this->updateStatusId = $id;
        $this->changeStatusModal = true;
    }

    public function changeStatus()
    {
        $this->validate();

        $ticket= TicketTicket::where('id', $this->updateStatusId)->first();
        $order = Order::where('id', $ticket->order_id)->first();

        if($this->status == TicketStatus::Completed->value){

            $this->dispatchBrowserEvent('order_completed', ['id' => $order->id]);
        }

        elseif($this->status == TicketStatus::Pending->value){
            $order->status = OrderStatus::Disputed->value;
        }elseif($this->status == TicketStatus::Resolved->value){
            $order->status = OrderStatus::InProgress->value;
        }elseif($this->status == TicketStatus::Cancelled->value){
            $this->dispatchBrowserEvent('order_refunded', ['id' => $order->id]);
        }

        $order->save();
        $updateStatusData = ['ticket_winner' => $this->status];

        // when ticket is updated then send mail to seller and buyer
        // if(TicketTicket::where('id',$this->updateStatusId)->update($updateStatusData)) {
        if($ticket->update($updateStatusData)) {
            $this->sendTicketUpdatedMail($ticket);
        }

        $this->changeStatusModal = false;
    }

    public function revertStatus()
    {
        TicketTicket::where('id',$this->updateStatusId)->update(['ticket_winner' => TicketStatus::Pending->value]);
    }

    // send status change mail function
    public function sendTicketUpdatedMail($ticket)
    {
        // send mail to buyer
        if($buyerMailData = Newsletter::where('type', EmailTemplateType::TicketUpdatedBuyer->value)->first()) {
            $subject = $buyerMailData->subject;

            $buyer_data = $this->sellerBuyerMailData($buyerMailData, $ticket, 'buyer');

            $buyer_mail_data = ['body' => $buyer_data['body'], 'subject' => $subject];
            $url = route('dispute_details', ['id' => $ticket->id]);
            dispatch(new SendEmailJob($buyer_mail_data, $buyer_data['to'], $url));
        }

        if($sellerMailData = Newsletter::where('type', EmailTemplateType::TicketUpdatedSeller->value)->first()) {
            $subject = $sellerMailData->subject;

            $seller_data = $this->sellerBuyerMailData($sellerMailData, $ticket, 'seller');

            $seller_mail_data = ['body' => $seller_data['body'], 'subject' => $subject];
            $url = route('seller.dispute-details', ['id' => $ticket->id]);
            dispatch(new SendEmailJob($seller_mail_data, $seller_data['to'], $url));
        }

    }

    public function sellerBuyerMailData($mailData, $ticket, $user_type)
    {
        $order = $ticket->order;

        $body = str_replace('{{order_id}}', $order->id, $mailData->body);
        $body = str_replace('{{service}}', GigDetail::where('gig_id', $order->gig_id)->first()->title, $body);
        $body = str_replace('{{seller}}', $order->seller->seller_name, $body);
        $body = str_replace('{{user}}', $ticket->buyer->name, $body);
        $body = str_replace('{{ticket_status}}', $ticket->ticket_winner, $body);

        if($user_type == 'seller'){
            $body = str_replace('{{order_amount}}', $order->orderDetails->total, $body);
            $to = $order->seller->user->email;

        } else {
            $body = str_replace('{{order_amount}}', $order->orderDetails->amount, $body);
            $to = $order->user->email;

        }

        return ['body' => $body, 'to' => $to];
    }

    public function render()
    {
        $tickets = TicketTicket::
                                join('common_database.users as buyer','buyer.id','=','tickets.buyer_id')
                                ->join('common_database.users as seller','seller.id','=','tickets.seller_id')
                                ->leftjoin('common_database.users as t_manager','t_manager.id','=','tickets.ticket_manager_id')
                                ->join('orders','orders.id','=','tickets.order_id')
                                ->selectRaw('
                                    tickets.id,tickets.ticket_winner,tickets.created_at,
                                    t_manager.name as manager, t_manager.id as manager_id,
                                    buyer.name as buyer,
                                    seller.name as seller,
                                    orders.id as order_id')
                                ->when($this->search, function($query){
                                    $query->where('tickets.created_at','like',"%$this->search%")
                                    ->orWhere('t_manager.name','like',"%$this->search%")
                                    ->orWhere('buyer.name','like',"%$this->search%")
                                    ->orWhere('seller.name','like',"%$this->search%");
                                })
                                ->when($this->statusFilter, function($query){
                                    $query->where('tickets.ticket_winner','=', $this->statusFilter);
                                })
                                ->when(auth()->user()->is_ticket_manager && !auth()->user()->is_admin, function($query){
                                    $query->where('tickets.ticket_manager_id', auth()->user()->id);
                                })
                                ->orderBy('tickets.id', 'DESC')
                                ->paginate(20);

        return view('livewire.admin.ticket.ticket', [
            'tickets' => $tickets
        ]);
    }

    public function getChatId($orderId)
    {
        $chat = Chat::where('content_type', 'Order')->where('content_id', $orderId)->first(['id']);
        return $chat->id;
    }
}
