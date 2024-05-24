<?php

namespace App\Http\Livewire\MessageCenter;

use App\Enums\OrderStatus;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Events\BlockUser;
use App\Events\UserStatus;
use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Events\UserOffline;
use App\Models\ChatCenter\Chat;
use App\Models\Seller\GigDetail;
use App\Http\Livewire\Admin\Users;
use App\Jobs\SendEmailJob;
use App\Models\ChatCenter\ChatStatus;
use App\Models\ChatCenter\ChatMessage;
use App\Models\Offer;
use App\Models\Order\Order;
use App\Models\Order\OrderDetail;
use App\Models\Seller\Seller;
use App\Models\Setting\RevenueConfiguration;
use VStelmakh\UrlHighlight\UrlHighlight;

class ChatArea extends Component
{

    public $chatMessages = [];
    public $selectedChat;
    public $receiverInstance;
    public $messagesCount;
    public $paginateVar = 10;
    public $isOnline;
    public $confirmBlock;
    public $blocked;
    public $blockedBy;
    public $confirmReport;
    public $chatId;
    public $access;
    public $perpage = 10;
    public $customOfferModal = false;
    public $offerTitle, $offerDetails, $offerPrice, $offerDuration;
    public $acceptCustomOfferModal = false ,$selectedOfferId ,$selectedMessageId;
    public $declineCustomOfferModal =false;
    public function getListeners()
    {

        $auth_id = auth()->user()->id;
        return [
            "echo-private:chatSent.{$auth_id},MessageSent"=>'broadcastedMessageReceived',
            "echo-private:chat.{$auth_id},MessageRead"=>'broadcastedMessageRead',
            "echo-private:chat.{$auth_id},BlockUser" => 'broadcastedBlockUser',
            // "echo-presence:chat-status,UserStatus" => 'onlineStatus',
            // "echo-presence:chat-status,here" => 'showOnline',
            // "echo-presence:chat-status,joining" => 'showOnline',
            // "echo-presence:chat-status,leaving" => 'hideOffline',
            'loadConversation', 'pushMessage', 'broadcastMessageRead', 'blockRefresh' => '$refresh',
            'loadMore'
        ];
    }

    public function broadcastedMessageReceived($event)
    {

        $this->emitTo('message-center.chat-list','refresh');
        // $this->emitTo('seller.seller-side-navbar','messageReceived');
        // $this->emitTo('new-header', 'messageReceived');
        $broadcastedMessage = ChatMessage::find($event['message_id']);

        if($this->selectedChat && isset($broadcastedMessage)){
            if((int) $this->selectedChat->id === (int) $event['chat_id']){
                $broadcastedMessage->is_seen= true;
                $broadcastedMessage->save();
                $this->pushMessage($broadcastedMessage->id);
                $this->emitSelf('broadcastMessageRead');

            }
        }
        $user = User::where('id', $event['user_id'])->first();
        $message = "New message recieved from ".$user?->name;
        session()->flash('message-received', $message);
    }

    public function broadcastMessageRead(){

        broadcast(new MessageRead($this->selectedChat->id,$this->receiverInstance->id));
    }

    public function broadcastedMessageRead($event)
    {

        if($this->selectedChat){

            if((int) $this->selectedChat->id === (int) $event['chat_id']){

                foreach($this->selectedChat->chatMessages->where('is_seen', false)  as $message){
                    $message->is_seen = true;
                    $message->save();
            }
                $this->dispatchBrowserEvent('markMessageAsRead');
            }
        }

    }

    public function showOnline(User $user)
    {
        $user->is_online = true;
        $user->save();
        $this->isOnline = true;
    }

    public function hideOffline(User $user)
    {

        $user->is_online = false;
        $user->save();
        $this->isOnline = false;
    }

    public function onlineStatus(User $user){

        $this->isOnline = $user->is_online;

    }

    public function render()
    {
        return view('livewire.message-center.chat-area');
    }

    public function mount($access = null)
    {
        $this->access = $access;
        if($this->chatId){
            $this->getchat();
        }

    }


    public function pushMessage($messageId)
    {
        $newMessage = ChatMessage::find($messageId);
        $this->chatMessages->push($newMessage);
        $this->dispatchBrowserEvent('chatSelected');
    }

    public function loadConversation(Chat $chat, User $receiver)
    {

        $this->selectedChat = $chat;

        $this->receiverInstance = $receiver;
        // $this->chatMessages = ChatMessage::where('chat_id', $this->selectedChat->id)->get();
        $this->chatMessages = ChatMessage::where('chat_id', $this->selectedChat->id)->latest()->take($this->perpage)->get();

        $this->chatMessages =  $this->chatMessages->sortBy('created_at');
        $this->isOnline = $receiver->isOnline();

        $this->dispatchBrowserEvent('chatSelected');
        $this->isBlocked();
    }

    public function loadMore()
    {
        $chatId = $this->selectedChat->id;
        $moreMessages = ChatMessage::where('chat_id', $chatId)->skip(count($this->chatMessages))->latest()->take($this->perpage)->get();
        $this->chatMessages = $moreMessages->merge($this->chatMessages);
        $this->chatMessages = $this->chatMessages->sortBy('created_at');
        $this->dispatchBrowserEvent('setScrollPosition', ['flag' => $moreMessages->count() >= $this->perpage]);
    }

    public function getLocalTime()
    {
        return [
            'time' => Carbon::now($this->receiverInstance->timezone)->format('h:i'),
            'noon' => Carbon::now($this->receiverInstance->timezone)->format('a')
        ];
    }

    public function blockModal()
    {
        $this->confirmBlock = true;
    }

    public function closeBlockModal()
    {
        $this->confirmBlock = false;
    }

    public function blockUser()
    {

       $chatStatus = new ChatStatus;
       $chatStatus->chat_id = $this->selectedChat->id;
       $chatStatus->blocked_by = auth()->user()->id;
       $chatStatus->save();
       $this->confirmBlock = false;
       broadcast(new BlockUser($this->selectedChat->id,$this->receiverInstance->id));
       $this->emit('blockRefresh');
       $this->isBlocked();

    }

    public function isBlocked()
    {
        $toBlocked = ChatStatus::where('chat_id', $this->selectedChat->id)
                                ->where('blocked_by',auth()->user()->id)
                                // ->orWhere('blocked_by', $this->receiverInstance->id)
                                ->first();
        $isBlocked = ChatStatus::where('chat_id', $this->selectedChat->id)
                                ->where('blocked_by', $this->receiverInstance->id)
                                ->first();
        if($isBlocked) {
            $this->blockedBy = $isBlocked->blocked_by;
        } elseif($toBlocked) {
            $this->blockedBy = $toBlocked->blocked_by;
        }


        if($toBlocked || $isBlocked) {

            $this->blocked = true;
            $this->emitTo('message-center.send-message', 'blocked');
        } else {
            $this->blocked = false;
            $this->emitTo('message-center.send-message', 'unBlocked');
        }


    }

    public function unblock()
    {
        $blockChat = ChatStatus::where('chat_id', $this->selectedChat->id)->where('blocked_by', auth()->user()->id)->first();
        $blockChat->blocked_by = null;
        $blockChat->save();

        broadcast(new BlockUser($this->selectedChat->id,$this->receiverInstance->id));
        $this->emit('blockRefresh');
        $this->isBlocked();

    }

    public function broadcastedBlockUser($event)
    {
        if($this->selectedChat){
            if($this->selectedChat->id == $event['chat_id'])
            {
                $this->isBlocked();
                $this->emit('blockRefresh');

            }
        }

    }

    public function getchat()
    {
        $this->selectedChat = Chat::where('id', $this->chatId)->first();
        if($this->selectedChat->sender_id == auth()->user()->id) {
            $this->receiverInstance = User::firstWhere('id',$this->selectedChat->receiver_id);
        }
        else{
            $this->receiverInstance = User::firstWhere('id', $this->selectedChat->sender_id);
        }


        $this->loadConversation($this->selectedChat, $this->receiverInstance);


    }

    public function getUser($id,$request){
        // if($role == 'seller'){
        //     Order::where('id',$this->selectedChat->content_id)
        // }
        $user = User::find($id);
        if($user){
            return $user->$request;
        }
    }

     public function getGig($request)
    {
        $gig_title = GigDetail::where('gig_id', $this->selectedChat->content_id)->first(['title','slug']);
        return $gig_title->$request;
    }

    public function highlightUrl($text)
    {
        $highlighter = new UrlHighlight();
        echo $highlighter->highlightUrls($text);
    }

    public function isURL($text)
    {
        $highlighter = new UrlHighlight();
        return $highlighter->isUrl('$text');
    }

    public function openOfferModal(){
        $this->customOfferModal = true;
    }

    public function submitOffer()
    {
        $this->validate([
            'offerTitle' => 'required|string|max:250',
            'offerDetails' => 'required|string|max:2000',
            'offerPrice' => 'required|numeric|min:1|max:5000',
            'offerDuration' => 'required|numeric|gte:1|max:99'
        ]);

        $createdMessage = ChatMessage::create([
            'message' => $this->offerTitle ?? null,
            'chat_id' => $this->selectedChat->id,
            'sent_by' => 'seller',
            'sender_id' => auth()->id(),
            'receiver_id' => $this->receiverInstance->id,
            'type' => 'offer',
            'sent_at' => Carbon::now()
        ]);
        $this->selectedChat->last_reply_at = $createdMessage->sent_at;
        $this->selectedChat->save();

        if($createdMessage){
            $offer = Offer::create([
                'title' => $this->offerTitle,
                'details' => $this->offerDetails,
                'price' => $this->offerPrice,
                'sender_id' => auth()->id(),
                'receiver_id' => $this->receiverInstance->id,
                'request_id' => $this->selectedChat->content_type == 'Proposal' ?  $this->selectedChat->content_id: null,
                'duration' => $this->offerDuration,
                'message_id' => $createdMessage->id
            ]);

            $data['subject'] = 'Offer Received from Seller';
            $data['body'] = 'You have got a new offer from seller';
            $mail_to = $this->receiverInstance;
            $url = route('messages', $this->selectedChat->id);
            dispatch(new SendEmailJob($data, $mail_to , $url));
        }
        $this->emitTo('message-center.chat-area', 'pushMessage', $createdMessage->id);
        $this->reset(['customOfferModal', 'offerTitle', 'offerDetails', 'offerPrice', 'offerDuration']);
    }

    public function confirmAcceptOrderModal($offerId, $messageId){
        $this->selectedOfferId = $offerId;
        $this->selectedMessageId = $messageId;
        $this->acceptCustomOfferModal = true;
    }

    public function declineOfferConfirmModal($offerId, $messageId){
        $this->selectedOfferId = $offerId;
        $this->selectedMessageId = $messageId;
        $this->declineCustomOfferModal = true;
    }

    public function acceptOffer(){
        $offer = Offer::find($this->selectedOfferId);
        if($offer){
            $seller  =Seller::where('user_id', $offer->sender_id)->first(['id']);
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'seller_id' => $seller->id,
                'has_attachments' => false,
                'status' => OrderStatus::UnPaid->value,
                'type' => 'offer',
                'offer_id' => $offer->id
            ]);

            $deliveryTime = Carbon::now()->addDays($offer->duration);

            // calculate commision
            $commission = ($offer->price/100) *  RevenueConfiguration::where('id', 1)->first('revenue_commision')->revenue_commision;
            $details  = new OrderDetail([
                'amount' => $offer->price,
                'total' => $offer->price - $commission,
                'commission' => $commission,
                'delivery_time' => $deliveryTime,

            ]);

            $order->orderDetails()->save($details);

            $this->selectedChat->save();
            return redirect(route('order.checkout', ['order' => $order]));
        }
    }

    public function declineOffer() {
        $offer = Offer::find($this->selectedOfferId);
        if($offer){
            $offer->status = 'declined';
            $offer->save();
            $this->closeOfferModal('declineCustomOfferModal');
            $this->selectedChat->last_reply_at = Carbon::now();
            $this->selectedChat->save();
            if(isset($this->selectedMessageId)){
                ChatMessage::find($this->selectedMessageId)->update([
                    'sent_at' => Carbon::now(),
                    'is_seen' => false
                ]);
            }


            $data['subject'] = 'Offer Declined By Buyer';
            $data['body'] = 'Your Offer has been declined by buyer';
            $mail_to = $offer->sender;
            $url = route('messages', $this->selectedChat->id);
            dispatch(new SendEmailJob($data, $mail_to , $url));
            $this->closeOfferModal('declineCustomOfferModal');
            $this->loadConversation($this->selectedChat, $this->receiverInstance);
        }

    }

    public function closeOfferModal($modal){
        $this->$modal = false;
        $this->reset(['selectedOfferId', 'selectedMessageId']);

    }

}
