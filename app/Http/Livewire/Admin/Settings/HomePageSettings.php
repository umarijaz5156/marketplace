<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Category;
use App\Models\ConfigHome;
use App\Models\Seller\Gig;
use App\Models\Seller\Seller;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomePageSettings extends Component
{
    use WithFileUploads;

    public $headerImage;
    public $header_title;
    public $header_description;

    public $popularCategoriesCheck;
    public $marketPlaceCheck;
    public $sellerCheck;
    public $gigCheck;

    public $popularCategoriesFilter = 1;
    public $popularCategoriesManual = [];
    public $marketPlaceFilter = 1;
    public $marketPlaceManual = [];
    public $sellerFilter = 1;
    public $sellerManual = [];
    public $gigsFilter = 1;
    public $gigManual = [];

    protected function rules()
    {
        return [
            'header_title' => 'required|string|min:10',
            'header_description' => 'required|string|min:5|max:500',
        ];
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function mount()
    {
        // config home
        $home = ConfigHome::where('id', '1')->first();
        $this->header_title = $home->title;
        $this->header_description = $home->description;

        $this->popularCategoriesCheck = $home->status1;
        $this->marketPlaceCheck = $home->status2;
        $this->sellerCheck = $home->status3;
        $this->gigCheck = $home->status4;

        if($home->status1 == 1) { // homepage popular category check
            $this->popularCategoriesManual = explode(',', $home->category_ids);
        } else {
            $this->popularCategoriesFilter = $home->popular_categories_filter;
        }

        if($home->status2 == 1) { // homepage market place check
            $this->marketPlaceManual = explode(',', $home->market_place_manual_categories);
        } else {
            $this->marketPlaceFilter = $home->market_place_filter;
        }

        if($home->status3 == 1) { // sellers check
            $this->sellerManual = explode(',', $home->seller_ids);
        } else {
            $this->sellerFilter = $home->seller_filter;
        }

        if($home->status4 == 1) { // gigs check
            $this->gigManual = explode(',', $home->gig_ids);
        } else {
            $this->gigsFilter = $home->gigs_filter;
        }
    }

    public function updatedHeaderTitle()
    {
        $this->validateOnly('header_title');
    }

    public function updatedHeaderDescription()
    {
        $this->validateOnly('header_description');
    }

    public function updateHomeConfig()
    {
        $this->validate([
            'header_title' => 'required|string|min:10',
            'header_description' => 'required|string|min:5|max:500',
            'popularCategoriesManual.*' => 'required_if:popularCategoriesCheck,1',
            'marketPlaceManual.*' => 'required_if:marketPlaceCheck,1',
            'sellerManual.*' => 'required_if:sellerCheck,1',
            'gigCheck.*' => 'required_if:gigManual,1'
        ]);
        $data = ['title' => $this->header_title, 'description' => $this->header_description];

        if ($this->popularCategoriesCheck == 1) {
            $data['status1'] = 1;
            $data['popular_categories_filter'] = 0;
            $data['category_ids'] = isset($this->popularCategoriesManual) ? implode(',', $this->popularCategoriesManual) : '';
        } else {
            $data['status1'] = 0;
            $data['category_ids'] = null;
            $data['popular_categories_filter'] = $this->popularCategoriesFilter;
        }

        if ($this->marketPlaceCheck == 1) {
            $data['status2'] = 1;
            $data['market_place_filter'] = 0;
            $data['market_place_manual_categories'] = isset($this->marketPlaceManual) ? implode(',', $this->marketPlaceManual) : '';
        } else {
            $data['status2'] = 0;
            $data['market_place_manual_categories'] = null;
            $data['market_place_filter'] = $this->marketPlaceFilter;
        }

        if ($this->sellerCheck == 1) {
            $data['status3'] = 1;
            $data['seller_filter'] = 0;
            $data['seller_ids'] = isset($this->sellerManual) ? implode(',', $this->sellerManual) : '';
        } else {
            $data['status3'] = 0;
            $data['seller_ids'] = null;
            $data['seller_filter'] = $this->sellerFilter;
        }

        if ($this->gigCheck == 1) {
            $data['status4'] = 1;
            $data['gigs_filter'] = 0;
            $data['gig_ids'] = isset($this->gigManual) ? implode(',', $this->gigManual) : '';
        } else {
            $data['status4'] = 0;
            $data['gig_ids'] = null;
            $data['gigs_filter'] = $this->gigsFilter;
        }

        if (isset($this->headerImage) && !empty($this->headerImage)) {
            $header_image_name = basename(parse_url($this->headerImage->temporaryUrl(), PHP_URL_PATH));
            $path  = Storage::disk('local')->get('/livewire-tmp/' . $header_image_name);
            if (Storage::disk('public')->put('/images/homePage/' . $header_image_name, $path)) {
                Storage::disk('public')->delete('/images/homePage/' . ConfigHome::where('id', '1')->first()->header_image);
                $data['header_image'] = $header_image_name;
            }
        }

        ConfigHome::where('id', '1')->update($data);
        session()->flash("success", "Record updated successfully.");

        $this->dispatchBrowserEvent('refresh');
    }

    public function render()
    {
        return view('livewire.admin.settings.home-page-settings', [
            'configHome' => ConfigHome::where('id', '1')->first(),
            'sellers' => Seller::all(),
            'gigs' => Gig::with('gigDetail')->where('is_active', true)->get(),
            'categories' => Category::with(['childCategories' => function ($query) {
                $query->with('childCategories');
            }])->whereNull('parent_id')->get()
        ]);
    }
}
