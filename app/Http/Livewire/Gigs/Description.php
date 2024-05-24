<?php

namespace App\Http\Livewire\Gigs;

use App\Models\Seller\GigImage;
use App\Models\Seller\GigPortfolio;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use FFMpeg;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\Format\Video\X264;
use FFMpeg\Media\Video;

class Description extends Component
{
    use WithFileUploads;

    public $description;
    public $descriptionCopy;
    public $additionalImages = [];
    public $requirements = [];
    public $requirement = [];
    public $featureImage;
    public $featureImageOldPath;

    public $faqs = [];
    public $answer = [];
    public $question = [] ;
    public $updateMode = false;
    public $inputs = [];
    public $i = 0;
    public $addedFaqs;
    public $gig;
    public $isEdit;
    public $isSet;
    public $disabled = false;

    public $reqInputs = [];
    public $x = 0;
    public $addedReq = [];
    public $options = [];

    public $portfolioImages = [];
    public $oldNames = [];
    public $oldGigFiles = [];
    public $isNew;

    protected $listeners = ['imageError', 'disableSubmit', 'enableSubmit', 'imageErrorPortfolio', 'disableSubmitPortfolio', 'enableSubmitPortfolio', 'removeFile', 'removeGigImage'];

    protected function rules()
    {
        return [
            'descriptionCopy' => 'required|string|min:10|max:1500',
            'featureImage' => ['required'],
            // 'additionalImages.*' => ['image', 'dimensions:min_width=712,min_height=430']
        ];
    }

    protected  $customRules = [
        '1' => [
            'requirement' => 'required',
        ],
        '2' => [
            'requirements.*.requirement' => 'required'
        ]
    ];


    protected $messages = [
        'descriptionCopy.required' => 'The description field is required.',
        'descriptionCopy.string' => 'The description must be a string.',
        'descriptionCopy.min' => 'The description must be at least 10 characters.',
        'descriptionCopy.max' => 'The description must not be greater than 1500 characters.',
    ];

    public function updatingDescription($value)
    {
        $this->descriptionCopy =  trim(strip_tags(html_entity_decode(html_entity_decode((htmlspecialchars($value))))));
    }

    public function updatedDescription($name, $value)
    {
        $this->validateOnly('descriptionCopy');
    }

    public function updatedFeatureImage()
    {
        $this->validateOnly('featureImage');
    }

    public function render()
    {
        return view('livewire.gigs.description');
    }

    public function previous()
    {
        $this->emitTo('forms.gig-create','previousStep');
    }

    public function mount()
    {
        if($this->gig){
            $this->isEdit = true;
            $this->fillEditData();
        } else{
            $this->isEdit = false;

        }
        $this->fillOldDate();
        if(old('faqs')){
            $this->faqs = old('faqs');
            $this->i  = count($this->faqs);
        }


    }


    public function publish()
    {

        if($this->x > 0){
          if(!$this->isEdit){

            $this->validate($this->customRules[1]);
          }

        }
        $this->validate();

        $time = strtotime(Carbon::now());

        if(in_array($this->featureImage->getClientOriginalName(), $this->oldGigFiles)){
            $featureImage['path'] = $this->featureImage->getClientOriginalName();
        } else{

            $featureImage['path'] = $this->featureImage->storeAs('/', $time.'_'.$this->featureImage->getClientOriginalName(), 'gigs');

        }
        $featureImage['mime_type'] = $this->featureImage->extension();

        $additionalImages = [];
        if(count($this->additionalImages) > 0){
            foreach ($this->additionalImages as $image) {
                if($image){

                    if(in_array($image->getClientOriginalName(), $this->oldGigFiles) && $this->isEdit) {

                        // $name = $image->getClientOriginalName();
                        continue;
                    } else{

                        $name = $image->storeAs('/', $time.'_'.$image->getClientOriginalName(), 'gigs');
                    }

                    array_push($additionalImages,[$name, $image->extension()]);
                }

            }
        }
        $portfolioImages = [];
        if(count($this->portfolioImages) > 0){


            $original_photo_storage = public_path('portfolio/original_images/');
            $medium_images_storage = public_path('portfolio/medium_images/');
            $mobile_images_storage = public_path('portfolio/mobile_images/');
            $tiny_images_storage = public_path('portfolio/tiny_images/');
            $thumbnail_path = public_path('portfolio/thumbnail');
            if(!File::exists($original_photo_storage)) {
                File::makeDirectory($original_photo_storage, 0777, true); //creates directory
            }
            if(!File::exists($medium_images_storage)) {
                File::makeDirectory($medium_images_storage, 0777, true); //creates directory
            }
            if(!File::exists($mobile_images_storage)) {
                File::makeDirectory($mobile_images_storage, 0777, true); //creates directory
            }
            if(!File::exists($tiny_images_storage)) {
                File::makeDirectory($tiny_images_storage, 0777, true); //creates directory
            }
            if(!File::exists($thumbnail_path)) {
                File::makeDirectory($thumbnail_path, 0777, true);
            }



                foreach($this->portfolioImages as $image){
                    $time = strtotime(Carbon::now());
                    if($image){

                        if($this->isEdit){

                            if(in_array($image->getClientOriginalName(), $this->oldNames)){

                                continue;
                            }
                        }
                        if($image->extension() == 'mp4' || $image->extension() == 'webm' || $image->extension() ==
                        'ogg'){

                            $videoPath = $image->storeAs('portfolio/videos',$time.'_'.$image->getClientOriginalName(), 'public');
                            // $videoPath = $request->input('video_path');

                            $thumbnailPath = 'portfolio/mobile_images';
                            $thumbnailName = $time. '.jpg';

                            FFMpeg::fromDisk('public')
                                ->open($videoPath)
                                ->getFrameFromSeconds(1) // Choose the time in seconds for the thumbnail
                                ->export()
                                ->toDisk('custom')
                                ->save( $thumbnailPath. '/' . $thumbnailName);
                                array_push($portfolioImages,[$videoPath ,$image->extension(),  $thumbnailName]);

                        } else{

                            $path =  $image->storeAs('/images', $time.'_'.$image->getClientOriginalName(), 'public');
                            $photo = Image::make(public_path('storage/'.$path));

                            $photo->save($original_photo_storage.$time.'_'.$image->getClientOriginalName(), 100)

                                ->resize(640, null, function ($constraint) {
                                    $constraint->aspectRatio();
                                    })->save($medium_images_storage.$time.'_'.$image->getClientOriginalName(),85)
                                        ->resize(420, null, function ($constraint) {
                                            $constraint->aspectRatio();
                                            })->save($mobile_images_storage.$time.'_'.$image->getClientOriginalName(),85)
                                            ->resize(10, null, function ($constraint) {
                                                $constraint->aspectRatio();
                                                })->blur(1)->save($tiny_images_storage.$time.'_'.$image->getClientOriginalName(),85);
                                                array_push($portfolioImages,[$time.'_'.$image->getClientOriginalName(), $image->extension()]);
                                            }

                    }
                }
            }


        if(count($this->question) > 0 && count($this->answer) > 0){
            foreach($this->question as $index=>$question){
                $this->addedFaqs[$index] = [$this->question[$index], $this->answer[$index]];
            }
        }

        if(count($this->requirement) > 0){
            foreach($this->requirement as $index=>$req){
                $this->addedReq[$index] = [$this->requirement[$index], $this->options[$index]];
            }
        }
        if(count($this->requirements) > 0){
            foreach($this->requirements as $index=>$req){
                array_push($this->addedReq, [$req['requirement'],$req['type']]);
             }
        }



        $this->emitTo('gigs.create','thirdStepData',
            $this->description,
            $this->addedReq,
            $this->addedFaqs,
            $this->isEdit ? $this->faqs : null,
            $featureImage,
            $additionalImages,
            $portfolioImages
        );
    }



    public function imageError($e)
    {

        if(isset($e['main'])) {
            $this->addError('imageMain',$e['main']);
           }
            if(isset($e['sub'])) {
                $this->addError('imageSub',$e['sub']);
            }
            else{
                $this->addError('imageMain',"Error occured while uploading image");
            }


    }

    public function disableSubmit($e)
    {
        $this->disabled = TRUE;
    }

    public function enableSubmit($e)
    {
        $this->disabled = FALSE;
    }

    public function imageErrorPortfolio($e)
    {

       if(isset($e['main'])) {
        $this->addError('imageMainPortfolio',$e['main']);
       }
        if(isset($e['sub'])) {
            $this->addError('imageSubPortfolio',$e['sub']);
        }
        else{
            $this->addError('imageMainPortfolio',"Error occured while uploading image");
        }

    }

    public function disableSubmitPortfolio($e)
    {
        $this->disabled = TRUE;
    }

    public function enableSubmitPortfolio($e)
    {
        $this->disabled = FALSE;
    }




    function fillOldDate()
    {



    }

    public function fillEditData()
    {

        $this->description = $this->gig->gigDetail->description;
        $this->descriptionCopy = trim(strip_tags(html_entity_decode(html_entity_decode((htmlspecialchars($this->gig->gigDetail->description))))));
        if($this->gig->gigFaqs){
            $this->faqs = $this->gig->gigFaqs->toArray();
            $this->i  = count($this->faqs);
        }
        if($this->gig->gigRequirements){
            $this->requirements = $this->gig->gigRequirements->toArray();
            $this->x = count($this->requirements);
        }

        foreach($this->gig->gigImages as $image){

            if($image->image_type  == 'M' ){
                $this->featureImage = $image->image_path;
            } elseif($image->image_type == 'A'){
                array_push($this->additionalImages, $image->image_path);

            }

            array_push($this->oldGigFiles, $image->image_path);
        }
        // dd($this->additionalImages)
        if($this->gig->portfolio) {

            foreach($this->gig->portfolio as $portfolio){
                if($portfolio->mime_type == 'mp4' || $portfolio->mime_type == 'webm' || $portfolio->mime_type ==
                'ogg'){

                    array_push($this->oldNames, $portfolio->thumbnail);
                    array_push($this->portfolioImages,$portfolio->thumbnail);
                } else{
                    array_push($this->portfolioImages, $portfolio->path);
                    array_push($this->oldNames, $portfolio->path);

                }
            }
        }




    }

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

    // add dynamic requiremnts
    public function addReq($x)
    {
        if($x < 5){
            $x = $x + 1;
            $this->x = $x;
            array_push($this->reqInputs, $x);
            $this->options[$x] = 'text';
        } else {
            $this->addError('requirement', 'Max 5 question allowed');
        }
    }

    public function removeReq($x)
    {
        unset($this->reqInputs[$x]);
        unset($this->requirements[$x]);
        $this->x -=1;
    }

    public function resetReqInput()
    {
        $this->reset('requirement');
    }
    public function removeFile($filename){

        if($filename){
          $portfolio =  GigPortfolio::where('path', $filename)->orWhere('thumbnail', $filename)->first();
          if($portfolio){
            $portfolio->delete();
          }

        }
    }

    public function removeGigImage($filename){

        if($filename){
            $image = GigImage::where('image_path', $filename)->first();
            if($image){
                $image->delete();
            }
        }
    }


}
