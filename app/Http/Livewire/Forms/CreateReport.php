<?php

namespace App\Http\Livewire\Forms;

use App\Models\Report;
use Livewire\Component;
use App\Enums\ReportType;

class CreateReport extends Component
{
    public $content;
    public $contentType;
    public $title;
    public $openModal;
    public $description;
    public $isReported;
    public $reportedBy;
    public $isBlock = false;

    protected $rules = [
        'description' => 'required'
    ];

    public function render()
    {
        if(auth()->check()){
            $this->checkReported();
        }
     
        return view('livewire.forms.create-report');
    }

    public function mount(){
        $this->openModal = false;
    }

    public function toggleModal(){
       
        $this->openModal = !$this->openModal;
        $this->isBlock = $this->openModal;
        $this->reset('description');
    }

    public function addReport()
    {
        $this->validate();

        if($this->contentType == ReportType::Gig->value){
            $contentOwner = $this->content->seller_id;
        } elseif($this->contentType == ReportType::Seller->value){
            $contentOwner = $this->content->id; 
        } elseif($this->contentType == ReportType::Review->value){
            $contentOwner = $this->content->from_user_id;
        } elseif($this->contentType == ReportType::Buyer->value){
            $contentOwner = $this->content->id; 
        } elseif($this->contentType == ReportType::Chat->value){
            if($this->content->sender_id == auth()->user()->id){
                $contentOwner =  $this->content->receiver_id;
            } else{
                $contentOwner = $this->content->sender_id;
            }
            
        }
        $report = Report::create([
            'content_type' => $this->contentType,
            'content_owner' => $contentOwner,
            'content_id' => $this->content->id,
            'reporter_id' => auth()->user()->id,
            'message' => $this->description,
        ]);

    //    $this->toggleModal();
       session()->flash('message', $this->contentType.' reported successfully');
    }

    public function checkReported(){
        $reports = Report::where('content_type', $this->contentType)->where('content_id', $this->content->id)
                            ->where('reporter_id', auth()->user()->id)->first();

        if($reports){
            
            $this->isReported = true;
        } else{
            $this->isReported = false;
        }
    }
}
