<?php

namespace App\Http\Livewire\Gigs;

use App\Enums\PackageType;
use App\Models\Seller\GigService;
use App\Rules\MaxChars;
use App\Rules\MaxWords;
use App\Rules\MinChars;
use App\Rules\MinWords;
use Livewire\Component;

class Pricing extends Component
{
    public $basicTitle;
    public $basicDescription;
    public $basicTime = 1;
    public $basicPrice = 5;
    public $mediumTitle;
    public $mediumDescription;
    public $mediumTime = 1;
    public $mediumPrice = 5;
    public $advanceTitle;
    public $advanceDescription;
    public $advanceTime = 1;
    public $advancePrice = 5;
    public $isAdvanced;
    public $oldServices = [];
    public $selectedService = [];
    public $gig;
    public $isEdit;
    public $basicSelectedService = [];
    public $basicService;
    public $mediumSelectedService = [];
    public $mediumService;
    public $advanceSelectedService = [];
    public $advanceService;
    public $serviceSuggestions = [];
    public $showBasic = false;
    public $showMedium = false;
    public $showPremium = false;


    protected function rules()
    {
        return [

            'basicTitle' => ['required', 'string', 'min:3', 'max:50'],
            'basicDescription' => ['required', 'string', 'min:3', 'max:60'],
            'basicTime' => ['required', 'numeric', 'min:1', 'max:90'],
            'basicPrice' => ['required', 'numeric', 'min:5', 'max:5000'],
            'mediumTitle' => ['required_if:isAdvanced,true', new MinChars(3, $this->isAdvanced), new MaxChars(50, $this->isAdvanced)],
            'mediumDescription' => ['required_if:isAdvanced,true', new MinChars(3, $this->isAdvanced), new MaxChars(60, $this->isAdvanced)],
            'mediumTime' => ['required_if:isAdvanced,true', 'numeric', 'min:1', 'max:99'],
            'mediumPrice' => ['required_if:isAdvanced,true', 'numeric', 'min:5', 'max:5000'],
            'advanceTitle' => ['required_if:isAdvanced,true', new MinChars(3, $this->isAdvanced), new MaxChars(50, $this->isAdvanced)],
            'advanceDescription' => ['required_if:isAdvanced,true', new MinChars(3, $this->isAdvanced), new MaxChars(60, $this->isAdvanced)],
            'advanceTime' => ['required_if:isAdvanced,true', 'numeric', 'min:1', 'max:99'],
            'advancePrice' => ['required_if:isAdvanced,true', 'numeric', 'min:5', 'max:5000'],
        ];
    }

    protected $messages = [
        'basicTitle.required'        => 'Required',
        'basicDescription.required'  => 'Required',
        'basicTime.required'         => 'Required',
        'basicPrice.required'        => 'Required',
        'mediumTitle.required_if'       => 'Required',
        'mediumDescription.required_if' => 'Required',
        'mediumTime.required_if'        => 'Required',
        'mediumPrice.required_if'       => 'Required',
        'advanceTitle.required_if'      => 'Required',
        'advanceDescription.required_if' => 'Required',
        'advanceTime.required_if'       => 'Required',
        'advancePrice.required_if'      => 'Required',
    ];

    protected $validationAttributes = [
        'basicTitle'            => 'Title',
        'basicDescription'      => 'Description',
        'basicTime'             => 'Time',
        'basicPrice'            => 'Price',
        'mediumTitle'           => 'Title',
        'mediumDescription'     => 'Description',
        'mediumTime'            => 'Time',
        'mediumPrice'           => 'Price',
        'advanceTitle'          =>  'Title',
        'advanceDescription'    =>  'Description',
        'advanceTime'           =>  'Time',
        'advancePrice'          =>  'Price',
    ];


    public function mount()
    {
        if ($this->gig) {
            $this->isEdit  = true;
        } else {
            $this->isEdit = false;
        }


        if ($this->isEdit) {

            $this->fillEditData();
        } else {
            $this->isAdvanced = false;
        }
    }

    public function previous()
    {
        $this->emitTo('forms.gig-create', 'previousStep');
    }

    public function next()
    {
        $this->validate();

        $basic = [
            'name' => $this->basicTitle,
            'type' => PackageType::Basic,
            'description' => $this->basicDescription,
            'price' => $this->basicPrice,
            'time' => $this->basicTime,
            'services' => $this->basicSelectedService
        ];
        $medium = [
            'name' => $this->mediumTitle,
            'type' => PackageType::Standard,
            'description' => $this->mediumDescription,
            'price' => $this->mediumPrice,
            'time' => $this->mediumTime,
            'services' => $this->mediumSelectedService
        ];
        $advance = [
            'name' => $this->advanceTitle,
            'type' => PackageType::Advance,
            'description' => $this->advanceDescription,
            'price' => $this->advancePrice,
            'time' => $this->advanceTime,
            'services' => $this->advanceSelectedService
        ];


        $this->emitTo(
            'gigs.create',
            'secondStepData',
            $this->isAdvanced,
            $basic,
            $medium,
            $advance,

        );
        $this->emitTo('forms.gig-create', 'nextStep');
    }

    public function render()
    {

        return view('livewire.gigs.pricing');
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function updatedIsAdvanced()
    {

        if (!$this->isAdvanced) {
            $this->reset([
                'mediumTitle', 'mediumDescription', 'mediumPrice', 'mediumTime', 'mediumSelectedService',
                'advanceTitle', 'advanceDescription', 'advancePrice', 'advanceTime', 'advanceSelectedService'
            ]);
        }
    }

    function fillOldDate()
    {
        if (old('packageType')) {
            $this->isAdvanced = true;
        }
        if (old('packages.basic.name')) {
            $this->basicTitle  = old('packages.basic.name');
        }
        if (old('packages.basic.price')) {
            $this->basicPrice = old('packages.basic.price');
        }
        if (old('packages.basic.time')) {
            $this->basicTime = old('packages.basic.time');
        }
        if (old('packages.basic.description')) {
            $this->basicDescription = old('packages.basic.description');
        }

        if (old('packages.medium.name')) {

            $this->mediumTitle  = old('packages.medium.name');
        }
        if (old('packages.medium.price')) {

            $this->mediumPrice = old('packages.medium.price');
        }
        if (old('packages.medium.time')) {

            $this->mediumTime = old('packages.medium.time');
        }
        if (old('packages.medium.description')) {

            $this->mediumDescription = old('packages.medium.description');
        }


        if (old('packages.advance.name')) {
            $this->advanceTitle  = old('packages.advance.name');
        }
        if (old('packages.advance.price')) {

            $this->advancePrice = old('packages.advance.price');
        }
        if (old('packages.advance.time')) {

            $this->advanceTime = old('packages.advance.time');
        }
        if (old('packages.advance.description')) {

            $this->advanceDescription = old('packages.advance.description');
        }

        if (old('services')) {
            $this->oldServices = old('services');
        }
    }

    public function fillEditData()
    {

        if (!isset($this->isAdvanced)) {
            $this->isAdvanced = $this->gig->package_type->value ? true : false;
        }

        foreach ($this->gig->gigPackages as $package) {
            if ($package->type == 0) {
                $this->basicTitle = $package->package_name;
                $this->basicDescription = $package->package_description;
                $this->basicPrice = $package->price;
                $this->basicTime = $package->delivery_days;
                if ($package->services) {
                    foreach ($package->services as $service) {
                        array_push($this->basicSelectedService, $service->name);
                    }
                }
            } elseif ($package->type == 1) {
                $this->mediumTitle = $package->package_name;
                $this->mediumDescription = $package->package_description;
                $this->mediumPrice = $package->price;
                $this->mediumTime = $package->delivery_days;
                if ($package->services) {
                    foreach ($package->services as $service) {
                        array_push($this->mediumSelectedService, $service->name);
                    }
                }
            } elseif ($package->type == 2) {
                $this->advanceTitle = $package->package_name;
                $this->advanceDescription = $package->package_description;
                $this->advancePrice = $package->price;
                $this->advanceTime = $package->delivery_days;
                if ($package->services) {
                    foreach ($package->services as $service) {
                        array_push($this->advanceSelectedService, $service->name);
                    }
                }
            }
        }
    }

    public function addService($type)
    {
        $this->resetErrorBag();
        if ($type == 'basic') {
            if (count($this->basicSelectedService) >= 10) {

                $this->addError('basicService', 'Max 10 allowed');
            } else if (in_array($this->basicService, $this->basicSelectedService)) {

                $this->addError('basicService', 'Service already exists');
            } elseif ($this->basicService == '') {
                $this->addError('basicService', 'Service cannot be empty');
            } else {

                array_push($this->basicSelectedService, $this->basicService);
                $this->basicService = '';
                $this->showBasic = true;
            }
        } elseif ($type == 'medium') {
            if (count($this->mediumSelectedService) >= 10) {

                $this->addError('mediumService', 'Max 10 allowed');
            } else if (in_array($this->mediumService, $this->mediumSelectedService)) {

                $this->addError('mediumService', 'Service already exists');
            } elseif ($this->mediumService == '') {
                $this->addError('mediumService', 'Service cannot be empty');
            } else {

                array_push($this->mediumSelectedService, $this->mediumService);
                $this->mediumService = '';
                $this->showMedium = true;
            }
        } elseif ($type == 'advance') {
            if (count($this->advanceSelectedService) >= 10) {

                $this->addError('advanceService', 'Max 10 allowed');
            } else if (in_array($this->advanceService, $this->advanceSelectedService)) {

                $this->addError('advanceService', 'Service already exists');
            } elseif ($this->advanceService == '') {
                $this->addError('advanceService', 'Service cannot be empty');
            } else {

                array_push($this->advanceSelectedService, $this->advanceService);
                $this->advanceService = '';
                $this->showPremium = true;
            }
        }
    }

    public function removeService($service, $type)
    {
        if ($type == 'basic') {
            $this->basicSelectedService = array_diff($this->basicSelectedService, [$service]);
        } elseif ($type == 'medium') {
            $this->mediumSelectedService = array_diff($this->mediumSelectedService, [$service]);
        } elseif ($type == 'advance') {
            $this->advanceSelectedService = array_diff($this->advanceSelectedService, [$service]);
        }
    }

    public function updatedBasicService()
    {
        $this->serviceSuggestions = GigService::where('name', 'LIKE', '%' . $this->basicService . '%')->get('name');
    }
    public function updatedMediumService()
    {
        $this->serviceSuggestions = GigService::where('name', 'LIKE', '%' . $this->mediumService . '%')->get('name');
    }
    public function updatedAdvanceService()
    {
        $this->serviceSuggestions = GigService::where('name', 'LIKE', '%' . $this->advanceService . '%')->get('name');
    }
}
