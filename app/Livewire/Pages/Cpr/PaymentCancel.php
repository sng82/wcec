<?php

namespace App\Livewire\Pages\Cpr;

use Livewire\Component;

class PaymentCancel extends Component
{
    public function render()
    {
        return view('livewire.pages.cpr.payment-cancel')
            ->layout('layouts.app');
    }
}
