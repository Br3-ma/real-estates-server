<?php

namespace App\Livewire\Payments;

use Livewire\Component;

class PaymentView extends Component
{
    public function render()
    {
        return view('livewire.payments.payment-view')->layout('layouts.app');
    }
}
