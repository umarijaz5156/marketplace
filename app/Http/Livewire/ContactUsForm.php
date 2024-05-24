<?php

namespace App\Http\Livewire;

use App\Mail\ContactUs;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class ContactUsForm extends Component
{
    public $name, $email, $phone, $message;
    
    protected $rules =[
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'message' => 'required'
    ];

    public function render()
    {
        return view('livewire.contact-us-form');
    }

    public function submit()
    {
        $this->validate();
        $contact = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message
        ];

        Mail::to(['support@pushiii.com'])
            ->send(new ContactUs($contact));
        
        session()->flash('message', 'Query sent successfully! we will reach you shortly');
    }
}
