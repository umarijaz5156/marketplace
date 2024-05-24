<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\MiscConfig;
use Livewire\Component;

class MiscSettings extends Component
{

    public $value= null;
    public $revisions = null;
    public function render()
    {

        return view('livewire.admin.settings.misc-settings');
    }

    public function mount(){
        $this->value = MiscConfig::where('name', 'order_complete')->first()?->value;
        $this->revisions = MiscConfig::where('name', 'revisions')->first()?->value;
    }

    public function updateMiscSettings(){

        $misc = MiscConfig::where('name', 'order_complete')->first();
        $revisions = MiscConfig::where('name', 'revisions')->first();
        if($misc){
            $misc->update([
                'value' => $this->value
            ]);


        }
        if($revisions){
            $revisions->update([
                'value' => $this->revisions
            ]);


        }
        redirect()->route('admin.configs')->with('success', 'Record updated successfully.');

    }

}
