<?php

namespace App\Livewire\Dashboard;

use App\Models\PropertyPost;
use App\Models\User;
use Livewire\Component;

class DashboardView extends Component
{
    public function render()
    {
        $properties = PropertyPost::get();
        $total_properties = $properties->count();
        $total_users = User::count() - 1;

        return view('livewire.dashboard.dashboard-view',[
            'properties'=>$properties,
            'total_properties'=>$total_properties,
            'total_users'=>$total_users
        ])->layout('layouts.app');
    }
}
