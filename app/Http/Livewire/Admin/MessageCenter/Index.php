<?php

namespace App\Http\Livewire\Admin\MessageCenter;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $chatId;
    public $users= [];

    public function render()
    {
        return view('livewire.admin.message-center.index')->layout('components.admin-layout');
    }

    public function updatingSearch($value)
    {
        if(empty($value)){
            $this->users = [];
            $this->emit('userClicked',null);
        } else {
            $this->users = User::where('name', 'like', "%$value%")->get();
        }
    }

    public function searchedUser($user_id)
    {
        $user = User::findOrFail($user_id);
        $this->search = $user->name;
        $this->users = [];
        $this->emit('userClicked',$user_id);
    }

    public function mount($id=null){
        $this->chatId = $id;
    }
}
