<?php

namespace App\Http\Livewire\Seller;


use App\Models\Seller\Skill;
use Livewire\Component;

class Profile extends Component
{
    public $description;
    public $selectSkills = [];
    public $skills;
    public $phoneNumber;
    public $address1;
    public $address2;
    public $paymentOption = ['Payoneer', 'Paypal'];

    public function mount()
    {
        $this->fillData();
    }

    public function render()
    {
        return view('livewire.seller.profile')->layout('components.seller.dashboard-layout');
    }

    public function fillData()
    {
       
        $data = auth()->user()->seller->sellerProfile;
        if($data){
            $this->description = $data->description;
            $this->phoneNumber = $data->phone;
            $this->address1 = $data->address_line1;
            $this->address2 = $data->address_line2;
            $this->skills = Skill::all();
        }
        $this->selectSkills = auth()->user()->seller->skills->pluck('id')->toArray();
    }

    public function rules() {
        return [
            'phoneNumber' => ['required', 'regex:/^\+(?:[0-9].?){6,14}[0-9]$/'],
        ];
    }

    public function updateProfileInformation()
    {
        $this->validate();

        
        $seller = auth()->user()->seller;

        // udpate seller_profile
        $profileUpdated = $seller->sellerProfile()->update([
            'description' => $this->description,
            'address_line1' => $this->address1,
            'address_line2' => $this->address2,
            'phone' => $this->phoneNumber
        ]);

        // udpate seller skills
        $skillsUpdated = $seller->skills()->sync($this->selectSkills);

        if($profileUpdated && $skillsUpdated)
        {
            session()->flash('success', 'saved');
        }

    }
}
