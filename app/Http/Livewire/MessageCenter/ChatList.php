<?php

namespace App\Http\Livewire\MessageCenter;

use App\Models\User;
use Livewire\Component;
use App\Events\MessageRead;
use App\Models\ChatCenter\Chat;
use App\Models\ChatCenter\ChatMessage;
use App\Models\Proposal;
use App\Models\Request;
use App\Models\Seller\GigDetail;
use Livewire\WithPagination;

class ChatList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $chats;
    public $auth_id;
    public $receiverInstance;
    public $selectedChat;
    public $unreadMessages;
    public $chatId;
    public $access;
    public $userId;
    public $perpage = 10;
    public $pageNumber = 1;
    public $totalChats;

    public function getListeners()
    {
        $auth_id = auth()->user()->id;
        return [
            "echo-private:chat.{$auth_id},ChatCreated" => 'refresh',
            // "echo-private:chat.{$auth_id},MessageRead" => '$refresh',
            'chatUserSelected','refresh',
            'userClicked' => 'assingUserId',
            'loadMoreThreads'
        ];
    }
    public function render()
    {
        $this->auth_id = auth()->id();
        $currentPage = $this->pageNumber;
        $offset = ($currentPage - 1) * $this->perpage;
        if($this->access == 'admin'){
            $this->chats = Chat::orderBy('last_reply_at', 'DESC')
                            ->when($this->userId, function($query){
                                $query->where('receiver_id', $this->userId);
                            })->take($this->perpage)->offset($offset)->get();
        }
        else{
            $this->chats = Chat::where('sender_id', $this->auth_id)
            ->orWhere('receiver_id', $this->auth_id)
            ->orderBy('last_reply_at', 'DESC')->take($this->perpage)->offset($offset)->get();
        }

        return view('livewire.message-center.chat-list');
    }

    public function nextPage(){
        if($this->perpage < $this->totalChats)
            $this->pageNumber = $this->pageNumber + 1;
    }

    public function previousPage(){
        $this->pageNumber = $this->pageNumber - 1 ;
    }

    public function mount($access= null)
    {
        $this->access = $access;
        $this->getChat();

    }

    public function assingUserId($event)
    {
        $this->userId = $event;
    }

    public function chatUserSelected(Chat $chat, $receiverId)
    {

        $this->selectedChat = $chat;
        $receiverInstance = User::find($receiverId);

        $this->emitTo('message-center.chat-area', 'loadConversation', $this->selectedChat,$receiverInstance);
        ChatMessage::where('chat_id', $chat->id)->where('is_seen', 0)->where('receiver_id', Auth()->user()->id)->update([
            'is_seen' => true
        ]);

        broadcast(new MessageRead($this->selectedChat->id,$receiverInstance->id));
        $this->emitTo('message-center.send-message', 'updateSendMessage', $this->selectedChat,$receiverInstance);
        $this->emitTo('seller.seller-side-navbar','messageRead');
        $this->emitTo('header', 'messageRead');

    }

    public function getChatUserInstance(Chat $chat, $request)
    {
        if($chat->sender_id == $this->auth_id) {
            $this->receiverInstance = User::firstWhere('id',$chat->receiver_id);
        }
        else{
            $this->receiverInstance = User::firstWhere('id', $chat->sender_id);
        }
        if(isset($request)){

            return $this->receiverInstance->$request;
        }
    }

    public function refresh()
    {
        $this->auth_id = auth()->id();
        $offset = ($this->page -1) * $this->perpage;
        if($this->access == 'admin'){


            $this->chats = Chat::orderBy('last_reply_at', 'DESC')
                            ->when($this->userId, function($query){
                                $query->where('receiver_id', $this->userId);
                            })->take($this->perpage)->offset($offset)->get();
        }
        else{

            $this->chats = Chat::where('sender_id', $this->auth_id)
            ->orWhere('receiver_id', $this->auth_id)
            ->orderBy('last_reply_at', 'DESC')->take($this->perpage)->offset($offset)->get();
        }
    }

    public function getGig($chat_id)
    {
        $chat = $this->chats->where('id', $chat_id)->first();
        $gig_title = GigDetail::where('gig_id', $chat->content_id)->first('title');
        return $gig_title->title ?? '';
    }

    public function getChat()
    {
        if($this->chatId){
            $chat = Chat::where('id', $this->chatId)->first();
            $this->selectedChat = $chat;

        }

        if($this->access == 'admin'){


            $this->totalChats =  Chat::orderBy('last_reply_at', 'DESC')
                            ->when($this->userId, function($query){
                                $query->where('receiver_id', $this->userId);
                            })->count();
        }
        else{

            $this->totalChats   = Chat::where('sender_id', auth()->user()->id)
            ->orWhere('receiver_id',  auth()->user()->id)->count();
        }

    }

    public function getUnreadMessages($chat){
        $chat = $chat->chatMessages->where('is_seen',0)->where('receiver_id', Auth()->user()->id)->count();

        if($chat > 0){
            $this->unreadMessages = $chat;
        }

    }

    public function getCurrentChatId()
    {

        return $this->selectedChat?->id;
    }

    public function getProposal($proposalId)
    {
        $request = Request::find($proposalId);
        if($request){
            return $request?->requirements ?? '';
        } else{
            return '';
        }
    }



}
