<?php

namespace App\Http\Livewire\Forms;

use App\Enums\EmailTemplateType;
use App\Events\ChatCreated;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Events\MessageSent;
use App\Jobs\SendEmailJob;
use App\Models\ChatCenter\Chat;
use App\Models\ChatCenter\ChatMessage;
use App\Models\Newsletter;
use App\Models\Order\Order;
use App\Models\Seller\Seller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateChat extends Component
{
    use AuthorizesRequests;

    public $gig;
    public $openModal;
    public $message;
    public $receiver_id;
    public $chat;
    public $createdMessage;
    public $orderId;
    public $isBlocked;
    public $type = null;
    public $receiver;
    public $createdChat;

    protected $rules = [
        'message' => 'required'
    ];

    protected $listeners = ['chatCreated'];

    public function render()
    {
        return view('livewire.forms.create-chat');
    }

    public function mount()
    {
        if($this->gig)
        {
            $this->receiver = User::where('id', $this->gig->seller->user_id)->first();
        } else{

            $order = Order::with(['seller'])->where('id', $this->orderId)->first('seller_id');

            $this->receiver = User::where('id', $order->seller->user_id)->first();
        }

        $this->openModal = false;

    }

    public function openModal()
    {
        if (!auth()->check()) {
            return redirect(route('login'));
        }
        $this->openModal = true;
    }

    public function sendMessage()
    {
        $this->validate();
        $this->checkChat();
        $this->emitSelf("chatCreated");
    }

    public function chatCreated()
    {
        broadcast(new ChatCreated($this->receiver->id));
    }

    public function checkChat()
    {
        $this->authorize('contact', Chat::class);
        $seller = Seller::where('user_id', auth()->user()->id)->first();

        if ( $seller?->id == $this->gig->seller_id) {
           return redirect($status=401);
        }

        if($this->gig){

            $sender = 'buyer';

            $this->chat = Chat::with('chatStatus')
            ->where('sender_id', auth()->user()->id)
            ->where('receiver_id', $this->receiver->id)
            ->where('content_type', 'Gig')
            ->where('content_id', $this->gig->id)
            ->first();


        } elseif($this->orderId) {
            $sender = auth()->user()->id == $this->order->seller_id ? 'seller' : 'buyer';
            $this->chat = Chat::with('chatStatus')
            ->where('sender_id', auth()->user()->id)
            ->where('receiver_id', $this->receiver->id)
            ->where('content_type', 'Order')
            ->where('content_id', $this->orderId)
            ->first();

        }

        if($this->chat && $this->chat->chatStatus)
        {

            foreach($this->chat->chatStatus as $chatStatus)
            {

                if($chatStatus->blocked_by)
                {
                    $this->isBlocked = true;
                    $this->addError('message', 'This Chat is Blocked');
                    break;
                }
            }
        }

        if(!$this->isBlocked)
        {
            if ($this->chat) {

                $this->createdMessage = ChatMessage::create([
                    'chat_id' => $this->chat->id,
                    'message' => $this->message,
                    'sent_by' => $sender,
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $this->receiver->id,
                    'sent_at' => Carbon::now()
                ]);

            $this->chat->last_reply_at = $this->createdMessage->sent_at;
            $this->chat->save();
            $this->openModal = false;
        } else {
            if($this->gig){
                $this->createdChat = Chat::create([
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $this->receiver->id,

                    'content_type' => 'Gig',
                    'content_id' => $this->gig->id,
                ]);

                // Send email to receiver about new conversation for gig
                if($emailData = Newsletter::where('type', EmailTemplateType::NewConversationGig->value)->first()){
                    $body = $emailData->body;

                    $mail_body = str_replace('{{seller}}', $this->gig->seller?->seller_name,$body);
                    $mail_body = str_replace('{{user}}', auth()->user()->name, $mail_body);
                    $mail_body = str_replace('{{service}}', $this->gig->title, $mail_body);


                    $data = ['body' => $mail_body, 'subject' => $emailData->subject];
                    if($user = User::find($this->receiver->id)){
                        $mail_to = $user->email;
                        if($sender= 'seller'){
                            $url = route('seller.message_details', ['id' => $this->createdChat->id]);
                        } else{
                            $url = route('messages', ['id' => $this->createdChat->id]);
                        }
                        dispatch(new SendEmailJob($data, $mail_to, $url));
                    }
                }

            } elseif($this->orderId){
                $this->createdChat = Chat::create([
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $this->receiver->id,
                    'content_type' => 'Order',
                    'content_id' => $this->orderId,
                ]);


            }


            $this->createdMessage = ChatMessage::create([
                'chat_id' => $this->createdChat->id,
                'message' => $this->message,
                'sent_by' => $sender,
                'sender_id' => auth()->user()->id,
                'receiver_id' => $this->receiver->id,
                'sent_at' => Carbon::now()
            ]);

            $this->createdChat->last_reply_at = $this->createdMessage->sent_at;
            $this->createdChat->save();
        }
        $this->openModal = false;
        if ($this->chat) {

            broadcast(new MessageSent(Auth()->user(), $this->createdMessage, $this->chat, $this->receiver));
            return redirect(route('messages', ['id' => $this->chat->id]));
        } elseif($this->createdChat){
            broadcast(new MessageSent(Auth()->user(), $this->createdMessage, $this->createdChat, $this->receiver));
            return redirect(route('messages', ['id' => $this->createdChat->id]));
        }


        }

    }
}
