<?php

namespace App\Livewire\Dashboard;

use App\Models\PropertyPost;
use Livewire\Component;

class DashboardView extends Component
{
    public function render()
    {
        $properties = PropertyPost::get();
        return view('livewire.dashboard.dashboard-view',[
            'properties'=>$properties
        ])->layout('layouts.app');
    }
}
