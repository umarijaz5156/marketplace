<?php

namespace App\Http\Livewire\MessageCenter;

use App\Models\ChatCenter\Chat;
use App\Models\Seller\Gig;
use App\Models\Seller\Seller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Facades\Route;


class Main extends Component
{
    use AuthorizesRequests;

    public $route;
    public $chatId;
    public $count;

    public function render()
    {

        $this->route =  Route::currentRouteName();
        $isSeller = Seller::where('user_id', auth()->user()->id)->first();
        $this->count = Chat::where('sender_id', auth()->user()->id)->orWhere('receiver_id', auth()->user()->id)->count();

        if(($this->route == 'seller_messages' || $this->route == 'seller.message_details') && $isSeller){
          if($this->chatId){
                $chat = Chat::find($this->chatId);
                $this->authorize('sellerView', $chat);
            }
            return view('livewire.message-center.main')->layout('components.seller.dashboard-layout');
        } elseif($this->route == 'admin.messages'){
            return view('livewire.message-center.main')->layout('components.admin-layout');
        }
        if($this->chatId){
            $chat = Chat::find($this->chatId);
            $this->authorize('userView', $chat);
        }

        if($isSeller)
        {
           return view('livewire.message-center.main')->layout('components.seller.dashboard-layout');
        }
        else
        return view('livewire.message-center.main')->layout('components.message-layout');

    }

    public function mount($id = null)
    {
        $this->chatId = $id;
    }
}
