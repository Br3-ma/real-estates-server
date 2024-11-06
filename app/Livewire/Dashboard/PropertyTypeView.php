<?php

namespace App\Livewire\Dashboard;

use App\Models\PropertyType;
use Livewire\Component;

class PropertyTypeView extends Component
{
    public $types;

    public function render()
    {
        $this->types = PropertyType::get();
        return view('livewire.dashboard.property-type-view')->layout('layouts.app');
    }
}
