<?php

namespace App\Http\Livewire\Forms;

use App\Models\Tag;
use App\Rules\MaxWords;
use Livewire\Component;
use App\Models\Category;
use App\Models\Seller\Seller;
use App\Rules\MinWords;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;

class GigCreate extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public $access = 'seller';
    public $sellers;
    public $seller;
    public $gig;
    public $title;
    public $tags;
    public $photo;
    public $photos = [];
    public $isAdvanced;
    public $userSelectedTags = [];
    public $tag;
    public $show = false;
    public $tagSuggestions = [];

    public $mainCategories = [];
    public $currentMainCategory;

    public $subCategories = [];
    public $currentSubCategory;

    public $subChildCategories = [];
    public $currentSubChildCategory;

    public $currentStep;
    public $isEdit;

    protected $listeners = ['previousStep', 'nextStep'];
    // child components

    protected function rules()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:70', 'unique:gig_details,title,'.$this->gig?->gigDetail?->id],

            'currentMainCategory' => ['required'],
            'currentSubChildCategory' => [],
            'userSelectedTags' => ['required'],
            'seller' => ['required_if:access,admin']
        ];
    }

    public function mount()
    {
        $this->currentStep = 1;
        if($this->gig){
            $this->isEdit = true;
        }else{
            $this->isEdit = false;
        }
        // $this->fillOldData();
        if(!$this->isEdit){
            $this->getMainCategories();
        }
        $this->getMainCategories();
        $this->isAdvanced = false;
        $this->getSellers();
        if($this->isEdit){
            $this->fillEditData();
        }

    }

    public function getSellers()
    {
        $this->sellers = Seller::get(['id','seller_name']);
    }

    public function previousStep()
    {
        $this->currentStep -= 1;
    }

    public function nextStep()
    {

        $this->currentStep +=1;
    }

    public function getMainCategories()
    {
        $this->mainCategories = Category::all()->whereNull('parent_id');
        if(isset($this->currentSubCategory)){

        }
    }

    public function updatedTitle()
    {
        $this->validateOnly('title');
    }

    public function updatedSeller()
    {
        $this->validateOnly('seller');
    }

    public function addTag()
    {

        if (count($this->userSelectedTags) > 4) {
            $this->addError('tag', 'Max 5 tags allowed');
        } elseif (in_array($this->tag, $this->userSelectedTags)) {

            $this->addError('tag', 'Tag already exists');
        } elseif($this->tag == '') {
            $this->addError('tag', 'Tag cannot be empty');
        }
        else {

            array_push($this->userSelectedTags, $this->tag);
            $this->tag = '';
            $this->show = true;
        }
    }

    public function removeTag($tag)
    {
        $this->userSelectedTags = array_diff($this->userSelectedTags, [$tag]);
    }

    //   search tags
    public function updatedTag()
    {
        $this->tagSuggestions = Tag::where('name', 'LIKE', '%' . $this->tag . '%')->get('name');
    }

    // on main category select
    public function updatedCurrentMainCategory()
    {

        //    get second level categories
        $this->validateOnly('currentMainCategory');
        if ($this->currentMainCategory) {
            $this->subChildCategories = [];
            $this->subCategories = [];
            $this->currentSubCategory = null;
            $this->currentSubChildCategory = null;
            $this->subCategories =  Category::where('parent_id', $this->currentMainCategory)->get();

        }
    }

    public function updatedCurrentSubCategory()
    {
        // get third level categories
        if ($this->currentSubCategory) {
            $this->subChildCategories = [];
            $this->currentSubChildCategory = null;
            $this->subChildCategories =  Category::where('parent_id', $this->currentSubCategory)->get();
        }
    }
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function render()
    {

        $this->authorize('create', Seller::class);
        return view('livewire.forms.gig-create');
    }

    public function next()
    {
        $this->validate();
        $this->emitTo('gigs.create', 'firstStepData',
        $this->title,
        $this->currentMainCategory,
        $this->currentSubCategory,
        $this->currentSubChildCategory,
        $this->userSelectedTags,
        $this->seller
    );
    $this->currentStep = 2;
}

function fillOldData()
{
    if (old('title')) {

        $this->title = old('title');
    }
    if (old('categories.0')) {
        $this->currentMainCategory = old('categories.0');
        $this->subCategories =  Category::where('parent_id', $this->currentMainCategory)->get();

    }

    if (old('categories.1')) {
        $this->currentSubCategory = old('categories.1');
        $this->subChildCategories =  Category::where('parent_id', $this->currentSubCategory)->get();
    }
    if (old('categories.2')) {
        $this->currentSubChildCategory = old('categories.2');
    }
    if (old('tags')) {
        $this->userSelectedTags = old('tags');
    }
}

public function fillEditData(){
    $this->seller = $this->gig->seller->id;
    $this->title = $this->gig->gigDetail->title;
    $categories = $this->gig->categories;

    foreach($categories as $category){

        if($category->pivot->level == 0){

            $this->currentMainCategory = $category->id;


        } elseif($category->pivot->level == 1){

            $this->currentSubCategory = $category->id;
            $this->subChildCategories =  Category::where('parent_id', $this->currentSubCategory)->get();


        } elseif($category->pivot->level == 2){
            $this->currentSubChildCategory = $category->id;
        }
    }

    foreach($this->gig->tags as $tag){
        array_push($this->userSelectedTags, $tag->name);
    }

}
}
