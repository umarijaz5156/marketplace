<?php

namespace App\Http\Livewire\Manager\MessageCenter;

use App\Models\ChatCenter\Chat;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests;

    public $chatId;

    public function render()
    {
        if($this->chatId){
            $chat = Chat::find($this->chatId);
            $this->authorize('view',$chat);
        }
      
        return view('livewire.manager.message-center.index')->layout('components.admin-layout');
    }

    public function mount($id=null){
        $this->chatId = $id;
    }
}
