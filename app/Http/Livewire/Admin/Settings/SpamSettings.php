<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\MiscConfig;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class SpamSettings extends Component
{
    public $keywords = [];
    public $selectedKeywords;

    protected $listeners = ['spamUpdated' => 'updateSpamKeyword'];
    public function render()
    {
        $keywords  = MiscConfig::where('name', 'spam_keywords')->first()['value'];

        $this->keywords = json_decode($keywords);
        return view('livewire.admin.settings.spam-settings');
    }

    public function updateSpamKeyword($value){
        $values = json_encode($value);
        MiscConfig::where('name', 'spam_keywords')->update([
            'value' => $values
        ]);
    }
}
