<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Livewire\Component;

class CustomersView extends Component
{
    public function render()
    {
        $users = User::get();
        return view('livewire.dashboard.customers-view',[
            'users'=>$users
        ])->layout('layouts.app');
    }
}
