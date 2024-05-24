<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting\RevenueConfiguration;
use Livewire\Component;

class RevenueConfigs extends Component
{
    public $comissionPercentage;
    public $refundComissionPercentage;

    public function rules()
    {
        return [
            "comissionPercentage" => "required|numeric|min:1",
            "refundComissionPercentage" => "required|numeric|min:1"
        ];
    }

    public function mount()
    {
        $this->comissionPercentage = RevenueConfiguration::first()->revenue_commision;
        $this->refundComissionPercentage = RevenueConfiguration::first()->refund_commission;
    }

    public function updateRevenueSettings()
    {
        $data = [
            'revenue_commision' => $this->comissionPercentage,
            'refund_commission' => $this->refundComissionPercentage
        ];

        RevenueConfiguration::where('id',1)->update($data);
        redirect()->route('admin.configs')->with('success', 'Record updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings.revenue-configs');
    }
}
