<?php

namespace App\Livewire\Dashboard;

use App\Models\Plan;
use Livewire\Component;

class PlansView extends Component
{
    public $plans;
    public function render()
    {
        $this->plans = Plan::get();
        return view('livewire.dashboard.plans-view')->layout('layouts.app');
    }
}
