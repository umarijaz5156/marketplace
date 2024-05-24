<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\AffiliateConfig;
use Livewire\Component;

class AffiliateSettings extends Component
{
    public $comissionPercentage;

    protected $rules = [
        'comissionPercentage' => 'required|numeric|gte:0'
    ];

    public function render()
    {
        return view('livewire.admin.settings.affiliate-settings');
    }

    public function mount()
    {
        $this->comissionPercentage = AffiliateConfig::where('title', 'commission')->first()->value;
    }

    public function updateCommissionSettings()
    {
        $this->validate();
        AffiliateConfig::where('title', 'commission')->update([
            'value' => $this->comissionPercentage
        ]);

        $this->dispatchBrowserEvent('refresh');
        // session()->flash("success", "Record updated successfully.");
    }
}
