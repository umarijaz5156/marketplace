<?php

namespace App\Http\Livewire\Affiliate;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Create extends Component
{

    public $link;

    public $isAffiliate;
    public function render()
    {

        return view('livewire.affiliate.create');
    }

    public function becomeAffiliate()
    {
        $user = User::find(auth()->user()->id);
        $user->is_affiliate = true;
        $link = now()->unix() . '_' . auth()->user()->name;
        $user->affiliate_link = $link;
        $user->save();
        $this->link = config('app.url')."/affiliate?affiliate_key=".$link;
        $this->isAffiliate = true;


    }

    public function mount()
    {
        $this->link = config('app.url')."/affiliate?affiliate_key=".auth()->user()->affiliate_link;
        $this->isAffiliate = !empty(auth()->user()->affiliate_link);

    }
}
