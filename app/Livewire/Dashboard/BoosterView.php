<?php

namespace App\Livewire\Dashboard;

use App\Models\Boost;
use Livewire\Component;

class BoosterView extends Component
{
    public $boosts;
    public function render()
    {
        $this->boosts = Boost::get();
        return view('livewire.dashboard.booster-view')->layout('layouts.app');
    }
}
