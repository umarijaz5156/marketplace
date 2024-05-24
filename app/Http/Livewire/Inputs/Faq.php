<?php

namespace App\Http\Livewire\Inputs;

use Livewire\Component;

class Faq extends Component
{
    public $faqs  =[];
    public $answer;
    public $question;
    public $updateMode = false;
    public $inputs = [];
    public $i = 0;

    public function add($i)
    {
        if($i < 5){
            $i = $i + 1;
            $this->i = $i;
            array_push($this->inputs, $i);
        } else {
            $this->addError('faq', 'Max 5 faqs allowed');
        }

      
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
        unset($this->faqs[$i]);
    }

    public function resetInputFields()
    {
        $this->answer = '';
        $this->question = '';
    }

    public function render()
    {
        return view('livewire.inputs.faq');
    }

    public function mount()
    {
        if(old('faqs')){
            $this->faqs = old('faqs');
            $this->i  = count($this->faqs);
        }
      
    }

  
}
