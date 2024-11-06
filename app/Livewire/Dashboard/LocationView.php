<?php

namespace App\Livewire\Dashboard;

use App\Models\Location;
use Livewire\Component;

class LocationView extends Component
{
    public $locations;

    public function render()
    {
        $this->locations = Location::get();
        return view('livewire.dashboard.location-view')->layout('layouts.app');
    }
}
