<?php

namespace App\Livewire\Pages\Cpr;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PaymentCancel extends Component
{
    use LivewireAlert;
    public function mount()
    {
        return $this->flash(
            'error',
            'Your payment was cancelled.<br> Please try again.',
            [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ],
            'cpr/dashboard'
        );
    }
    public function render()
    {
        return view('livewire.pages.cpr.payment-cancel')
            ->layout('layouts.app');
    }
}
