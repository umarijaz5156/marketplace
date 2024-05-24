<?php

namespace App\Http\Livewire\Gigs;


use App\Models\Seller\GigPortfolio;
use Carbon\Carbon;
use App\Models\Tag;
use Livewire\Component;
use App\Enums\ImageType;
use App\Models\Category;
use App\Enums\PackageType;
use App\Models\Seller\Gig;
use Illuminate\Support\Str;
use App\Models\Seller\GigFaq;
use App\Models\Seller\Seller;
use App\Models\Seller\GigStat;
use App\Models\Seller\GigImage;
use App\Models\Seller\GigDetail;
use App\Models\Seller\GigPackage;
use App\Models\Seller\GigService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller\GigRequirement;
use Illuminate\Support\Facades\Log;

class Create extends Component
{

    public $access = 'seller';
    public $currentStep;
    public $gig;
    public $title;
    public $categories = [];
    public $tags;
    public $seller;

    public $packages = [];
    public $packageType;
    public $services;

    public $description;
    public $faqs = [];
    public $requirement;
    public $featureImage;
    public $additionalImages = [];
    public $portfolioImages = [];
    public $isEdit;
    public $editFaqs;

    protected $listeners = ['firstStepData', 'secondStepData', 'thirdStepData'];

    public function mount($id = null)
    {
        if ($id) {
            $this->gig = Gig::with(['seller', 'gigDetail', 'gigImages', 'tags', 'gigPackages' => function ($query) {
                $query->with('services');
            }, 'gigFaqs', 'gigRequirements', 'categories'])
                ->where('id', $id)->first();
            $this->isEdit = true;
        } else {
            $this->isEdit = false;
        }

        $this->currentStep  = 1;
    }

    public function render()
    {
        return view('livewire.gigs.create')->layout('components/seller/dashboard-layout');
    }


    public function firstStepData($title, $mainCategory, $subCategory, $subChildCategory, $tags, $seller)
    {

        $this->seller = $seller;
        $this->title = $title;
        if ($this->isEdit && $subChildCategory) {
            $thirdCategory = Category::where('id', $subChildCategory)->first();
            array_push($this->categories, $mainCategory, $subCategory,  $thirdCategory);
        } else {
            array_push($this->categories, $mainCategory, $subCategory, $subChildCategory);
        }

        $this->tags = $tags;

        $this->currentStep = 2;
    }

    public function secondStepData($packageType, $basic, $medium, $advance)
    {

        $this->packages = [
            'basic' => $basic,
            'medium' => $medium,
            'advance' => $advance,

        ];

        $this->packageType = $packageType;
        $this->currentStep = 3;
    }

    public function thirdStepData($description, $requirement, $faqs, $editFaqs, $featureImage, $additionalImages, $portfolioImages)
    {

        $this->description = $description;
        $this->requirement = $requirement;
        $this->featureImage = $featureImage;
        $this->additionalImages = $additionalImages;
        $this->portfolioImages = $portfolioImages;
        if (isset($editFaqs)) {
            $this->editFaqs = $editFaqs;
        }
        if (isset($faqs)) {
            $this->faqs = $faqs;
        }


        $this->isEdit;
        if ($this->isEdit) {
            $this->update();
        } else {
            $this->submit();
        }
    }

    // add a new gig
    public function submit()
    {

        try {
            DB::beginTransaction();

            if ($this->access == 'admin') {
                $seller = Seller::find($this->seller);
            } else {
                $seller = Seller::where('user_id', Auth::user()->id)->first();
            }

            $packageType = $this->packageType ? PackageType::Standard->value : PackageType::Basic->value;
            $gig =  Gig::create([
                'seller_id' => $seller->id,
                'package_type' =>  $packageType
            ]);

            // add gig descirption
            $gigDetail = new GigDetail;
            $gigDetail->title = $this->title;
            $gigDetail->description = $this->description;
            $gigDetail->slug = Str::slug($this->title);
            $gig->gigDetail()->save($gigDetail);


            //    add categories
            foreach ($this->categories as $index => $category) {

                if (!is_null($category)) {
                    $gig->categories()->attach($category, ['level' => $index]);
                }
            }
            // store main image

            $gigImage = new GigImage;

            $gigImage->image_path = $this->featureImage['path'];
            $gigImage->image_type = ImageType::Main;
            $gigImage->mime_type = $this->featureImage['mime_type'];
            $gig->gigImages()->save($gigImage);

            // store additional images
            if (count($this->additionalImages) > 0) {

                foreach ($this->additionalImages as $image) {

                    $gigImage = new GigImage;
                    $gigImage->image_path = $image[0];
                    $gigImage->mime_type = $image[1];
                    $gigImage->image_type = ImageType::Additional;
                    $gig->gigImages()->save($gigImage);
                }
            }

            if(count($this->portfolioImages) > 0){
                foreach ($this->portfolioImages as $image) {
                    $portfolio = new GigPortfolio;
                    $portfolio->path = $image[0];
                    $portfolio->mime_type = $image[1];
                    if( $image[1] == 'mp4' ||  $image[1] == 'webm' ||  $image[1] ==
                    'ogg'){
                        if(isset($image[2])){
                            $portfolio->thumbnail = $image[2];
                        }
                    }
                    $portfolio->is_new = true;
                    $gig->portfolio()->save($portfolio);
                }
            }

            // add gig tags
            foreach ($this->tags as $tag) {
                $tags  = Tag::where('name', Str::lower($tag))->get();
                if (count($tags) > 0) {

                    $gig->tags()->attach($tags);
                } else {

                    $tags = new Tag;
                    $tags->name = $tag;
                    $tags->save();
                    $gig->tags()->attach($tags);
                }
            }

            // create gig stats
            $gigStat = new GigStat;
            $gig->gigStat()->save($gigStat);

            // add packages to gig
            foreach ($this->packages as $package) {

                $gigPackage = new GigPackage;
                $gigPackage->type = $package['type'];
                $gigPackage->package_name = $package['name'];
                $gigPackage->package_description = $package['description'];
                $gigPackage->price = $package['price'];
                $gigPackage->delivery_days = $package['time'];


                $gig->gigPackages()->save($gigPackage);
                if ($package['services']) {
                    foreach ($package['services'] as $service) {
                        $newService  = new GigService([
                            'name' => $service
                        ]);
                        $newService->save();
                        $gigPackage->services()->attach($newService);
                    }
                }

                if (!$packageType) {
                    break;
                }
            }


            // store gig faqs
            if (count($this->faqs) > 0) {
                foreach ($this->faqs as $gigFaq) {

                    if (isset($gigFaq[0]) && isset($gigFaq[1])) {
                        $newGigFaq = new GigFaq;
                        $newGigFaq->question = $gigFaq[0];
                        $newGigFaq->answer = $gigFaq[1];
                        $gig->gigFaqs()->save($newGigFaq);
                    }
                }
            }


            // store gig requirement
            if (count($this->requirement) > 0) {
                foreach($this->requirement as $req){
                    $gigRequirement = new GigRequirement;
                    $gigRequirement->requirement = $req[0];
                    $gigRequirement->type = $req[1];
                    $gig->gigRequirements()->save($gigRequirement);
                }

            }

            // update seller stats
            $seller->increment('gigs_count');
        } catch (\Exception $e) {
            DB::rollBack();

            $message = 'Error occured please try again';
            $response = [
                'message' => $message,
                'type' => 'error'
            ];
            $route = $this->access == 'admin' ? 'admin.gigs' : 'gig_index';

            return redirect(route($route))->with('message', $response);
        }

        DB::commit();
        $message = 'Service Saved Successfully';
        $response = [
            'message' => $message,
            'type' => 'success'
        ];

        $route = $this->access == 'admin' ? 'admin.gigs' : 'gig_index';

        return redirect(route($route))->with('message', $response);
    }

    // update a gig
    public function update()
    {

        if ($this->access == 'admin') {
            $seller = $this->seller;
        } else {
            $seller = Seller::where('user_id', Auth::user()->id)->first()->id;
        }
        $gig = Gig::find($this->gig->id);
        $gig->seller_id = $seller;
        $gig->edited_by = auth()->user()->id;
        $gig->package_type = $this->packageType;
        // $gig->is_approved = true;
        $gig->save();

        $gigDetails = $gig->gigDetail()->first();
        $gigDetails->title = $this->title;
        $gigDetails->description = $this->description;
        $gig->gigDetail()->save($gigDetails);


        $categoryIds  = [];

        foreach ($this->categories as $index => $category) {

            if (!is_null($category) ) {

                if(is_array($category))
                array_push($categoryIds, $category['id']);
                else
                array_push($categoryIds, $category);
            }
        }
        if (count($categoryIds) == 3) {
            $gig->categories()->sync([
                $categoryIds[0] =>  ['level' => 0],
                $categoryIds[1] =>  ['level' => 1],
                $categoryIds[2] =>  ['level' => 2],

            ]);
        } elseif (count($categoryIds) == 2) {
            $gig->categories()->sync([
                $categoryIds[0] =>  ['level' => 0],
                $categoryIds[1] =>  ['level' => 1]

            ]);
        } elseif (count($categoryIds) == 1) {
            $gig->categories()->sync([
                $categoryIds[0] =>  ['level' => 0],

            ]);
        }

        // update tags
        $tagsId = [];
        foreach ($this->tags as $tag) {
            $tags  = Tag::where('name', Str::lower($tag))->first();
            if ($tags) {
                array_push($tagsId, $tags->id);
            } else {

                $tags = new Tag;
                $tags->name = $tag;
                $tags->save();
                array_push($tagsId, $tags->id);
            }
        }
        $gig->tags()->sync($tagsId);

        // update packages

        // remove previous packages if is advanced is false
        if (!$this->packageType) {
            $gig->gigPackages()->where('type', '!=', 0)->delete();
        }
        foreach ($this->packages as $package) {
            if ($package['name']) {
                $gigPackage = $gig->gigPackages()->where('type', $package['type'])->first();

                if ($gigPackage) {
                    $gigPackage->type = $package['type'];
                    $gigPackage->package_name = $package['name'];
                    $gigPackage->package_description = $package['description'];
                    $gigPackage->price = $package['price'];
                    $gigPackage->delivery_days = $package['time'];

                    if ($package['services']) {
                        $serviceIds = [];
                        foreach ($package['services'] as $service) {
                            $packageServices = $gigPackage->services()->get();
                            if (count($packageServices) > 0) {
                                $old = $packageServices->where('name', $service)->first();

                                if ($old) {
                                    array_push($serviceIds, $old->id);
                                } else {
                                    $newService  = new GigService([
                                        'name' => $service
                                    ]);
                                    $newService->save();
                                    array_push($serviceIds, $newService->id);
                                }
                            } else {
                                $newService  = new GigService([
                                    'name' => $service
                                ]);
                                $newService->save();
                                array_push($serviceIds, $newService->id);
                            }
                        }
                        $gigPackage->services()->sync($serviceIds);
                    } else {
                        $gigPackage->services()->delete();
                    }
                    $gig->gigPackages()->save($gigPackage);
                } else {
                    $newgigPackage = new GigPackage;
                    $newgigPackage->type = $package['type'];
                    $newgigPackage->package_name = $package['name'];
                    $newgigPackage->package_description = $package['description'];
                    $newgigPackage->price = $package['price'];
                    $newgigPackage->delivery_days = $package['time'];
                    $gig->gigPackages()->save($newgigPackage);
                    if ($package['services']) {
                        foreach ($package['services'] as $service) {
                            $newService  = new GigService([
                                'name' => $service
                            ]);
                            $newService->save();
                            $newgigPackage->services()->attach($newService);
                        }
                    }
                    $gig->gigPackages()->save($newgigPackage);
                }
            }
        }

        // update faqs
        if (count($this->editFaqs) > 0) {
            $gig->gigFaqs()->delete();
            foreach ($this->editFaqs as $faq) {
                $newfaq = new GigFaq([
                    'id' => $faq['id'],
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],

                ]);
                $gig->gigFaqs()->save($newfaq);
            }
        }

        // $gigIds = [];
        if (count($this->faqs) > 0) {
            foreach ($this->faqs as $gigFaq) {

                if (isset($gigFaq[0]) && isset($gigFaq[1])) {
                    $newGigFaq = new GigFaq;
                    $newGigFaq->question = $gigFaq[0];
                    $newGigFaq->answer = $gigFaq[1];
                    $gig->gigFaqs()->save($newGigFaq);
                }
            }
        }


        if (isset($this->requirement)) {

            $gig->gigRequirements()->delete();
            foreach($this->requirement as $req){
                $gigRequirement = new GigRequirement;
                $gigRequirement->requirement = $req[0];
                $gigRequirement->type = $req[1];
                $gig->gigRequirements()->save($gigRequirement);
            }

        }

        if (isset($this->featureImage)) {
            $gig->mainImage()->delete();
            $gigImage = new GigImage;
            $gigImage->image_path = $this->featureImage['path'];
            $gigImage->mime_type = $this->featureImage['mime_type'];
            $gigImage->image_type = ImageType::Main;
            $gig->gigImages()->save($gigImage);
        }
        // $gig->gigImages()->where('image_type', 'A')->delete();
        // store additional images
        if (count($this->additionalImages) > 0) {

            foreach ($this->additionalImages as $image) {
                $gigImage = new GigImage;
                $gigImage->image_path = $image[0];
                $gigImage->mime_type = $image[1];
                $gigImage->image_type = ImageType::Additional;
                $gig->gigImages()->save($gigImage);
            }
        }



        if(count($this->portfolioImages) > 0){
            foreach ($this->portfolioImages as $image) {

                $portfolio = new GigPortfolio;
                $portfolio->path = $image[0];
                $portfolio->mime_type = $image[1];
                if( $image[1] == 'mp4' ||  $image[1] == 'webm' || $image[1]  ==
                'ogg'){
                    if(isset($image[2])){
                        $portfolio->thumbnail = $image[2];
                    }
                }
                $portfolio->is_new = true;
                $gig->portfolio()->save($portfolio);
            }
        }


        $message = 'Gig Updated Successfully';
        $response = [
            'message' => $message,
            'type' => 'success'
        ];

        $route = $this->access == 'admin' ? 'admin.gigs' : 'gig_index';

        return redirect(route($route))->with('message', $response);
    }


    public function previousStep()
    {
        $this->currentStep -= 1;
    }
}
