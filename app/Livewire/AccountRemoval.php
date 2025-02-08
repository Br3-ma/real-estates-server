<?php

namespace App\Livewire;

use Livewire\Component;

class AccountRemoval extends Component
{
    public function render()
    {
        return view('livewire.account-removal')->layout('layouts.guest');
    }
}
