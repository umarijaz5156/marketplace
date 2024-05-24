<?php

namespace App\Http\Livewire\Requests;

use App\Jobs\SendEmailJob;
use App\Models\Category;
use App\Models\Request;
use Livewire\Component;

class Index extends Component
{
    public $openModal = false;
    public $mainCategories = [];
    public $subCategories = [];

    public $currentMainCategory;
    public $currentSubCategory;
    public $requirements;
    public $minBudget = 0;
    public $maxBudget = 100;
    public $duration;
     public $sortField = 'id';
    public $sortAsc = false;
    public $editModal = false;
    public $editRequest;
    public $status;
    public $active = 0;

    public $selectedFilter = 'active';

    public function render()
    {
        $requests = Request::where('user_id', auth()->user()->id)->when($this->sortField, function($query) {
            $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        })->where('status', $this->selectedFilter)->paginate(10);
        return view('livewire.requests.index', [
            'requests' => $requests
        ]);
    }

    public function showModal(){
        $this->openModal = true;
        $this->reset(['currentMainCategory', 'currentSubCategory', 'minBudget', 'maxBudget', 'requirements']);
    }

    public function mount(){
        // $this->getRequests();
        $this->getMainCategories();
    }

    public function getMainCategories()
    {
        $this->mainCategories = Category::all()->whereNull('parent_id');

    }

    public function updatedCurrentMainCategory(){
        if ($this->currentMainCategory) {
            $this->currentSubCategory = null;
            $this->subCategories =  Category::where('parent_id', $this->currentMainCategory)->get();
        }
    }

    public function submit(){
        $this->validate([
            'currentMainCategory' => 'required',
            'minBudget' => 'required|numeric|min:0|max:'. $this->maxBudget ?? 5000,
            'maxBudget' => 'required|numeric|min:'. $this->minBudget ?? 0 .'|max:5000',
            'requirements' => 'string|min:10|max:2000',
            'duration' => 'required|numeric|min:1|max:999'
        ]);

        $request = Request::create([
            'category_id' => $this->currentSubCategory != '' ?  $this->currentSubCategory : $this->currentMainCategory,
            'user_id' => auth()->user()->id,
            'min_budget' => $this->minBudget,
            'max_budget' => $this->maxBudget,
            'requirements' => $this->requirements,
            'duration' => $this->duration
        ]);

        $data['subject'] = 'Job Posted';
        $data['body'] = 'Your job has been posted, we will notify you when anyone bids on your job post.';
        $mail_to = auth()->user();
        $url = route('requests.details', $request->id);
        dispatch(new SendEmailJob($data, $mail_to , $url));
        session()->flash('success', 'Request Created Successfully');

        $this->reset(['openModal', 'currentMainCategory', 'currentSubCategory', 'minBudget', 'maxBudget', 'requirements', 'duration']);
    }

    public function sortBy($field)
    {
        if($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function openEditModal($id){
        $this->reset(['subCategories','currentMainCategory', 'currentSubCategory', 'minBudget', 'maxBudget', 'requirements', 'duration']);
        $this->editModal = true;
        $this->editRequest = $id;
        $request = Request::find($id);
        $this->requirements = $request->requirements;
        $this->minBudget = $request->min_budget;
        $this->maxBudget = $request->max_budget;
        $this->duration = $request->duration;
        $this->status = $request->status;
        $category = Category::find($request->category_id);

        if($category){
            if($category->parent_id == null){
                $this->currentMainCategory = $category->id;
                $this->subCategories =  Category::where('parent_id', $category->id)->get();
            } else{
                $this->subCategories =  Category::where('parent_id', $category->parent_id)->get();
                $this->currentMainCategory = $category->parent_id;
                $this->currentSubCategory = $category->id;
            }
        }
    }

    public function update(){
        $this->validate([
            'currentMainCategory' => 'required',
            'minBudget' => 'required|numeric|min:0|max:'. $this->maxBudget ?? 5000,
            'maxBudget' => 'required|numeric|min:'. $this->minBudget ?? 0 .'|max:5000',
            'requirements' => 'string|min:10|max:2000'
        ]);
        $reqeust = Request::find($this->editRequest);
        if($reqeust){
            $reqeust->requirements = $this->requirements;
            $reqeust->min_budget = $this->minBudget;
            $reqeust->max_budget = $this->maxBudget;
            $reqeust->category_id  = isset($this->currentSubCategory) ?  $this->currentSubCategory : $this->currentMainCategory;
            $reqeust->status = $this->status;
            $reqeust->duration = $this->duration;
            $reqeust->update();
            session()->flash('success', 'Request Updated Successfully');

            $this->reset(['editModal','status','editRequest' , 'currentMainCategory', 'currentSubCategory', 'minBudget', 'maxBudget', 'requirements', 'duration']);
        }
    }

    public function changeStatus($value,$index)
    {

        $this->selectedFilter = $value;
        $this->active = $index;
    }


}
