<?php

namespace App\Http\Livewire\Admin;

use App\Models\ConfigBasic;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageSettings extends Component
{
    use WithFileUploads;
    
    public $logo;
    public $site_title;
    public $favIcon;    

    protected function rules()
    {
        return [
            'site_title' => 'required|string|min:4',
        ];
    }

    public function mount()
    {
        // config basics
        $basics = ConfigBasic::where('id','1')->first();
        $this->site_title = $basics->site_title;
        $this->favIcon = $basics->fav_icon;
        $this->logo = $basics->logo_image;
    }

    public function updatedSiteTitle()
    {
        $this->validateOnly('site_title');
    }

    public function render()
    {
        return view('livewire.admin.manage-settings', [
            'configBasic' => ConfigBasic::where('id', '1')->first(),
        ]);
    }
}
