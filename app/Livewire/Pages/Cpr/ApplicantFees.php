<?php

namespace App\Livewire\Pages\Cpr;

use Livewire\Component;
use App\Models\Prices;

class ApplicantFees extends Component
{
    public $registration_fee;
    public $application_fee;
    public $renewal_fee;

    public function render()
    {
        $this->registration_fee = Prices::where('price_type', 'registration')
                               ->where('start_date', '<=', now())
                               ->where(function($query) {
                                                $query->where('end_date', '>', now())
                                                      ->orWhere('end_date', null);
                                            })
                               ->orderBy('start_date')
                               ->first();

        $this->application_fee = Prices::where('price_type', 'application')
                                      ->where('start_date', '<=', now())
                                      ->where(function($query) {
                                               $query->where('end_date', '>', now())
                                                     ->orWhere('end_date', null);
                                           })
                                      ->orderBy('start_date')
                                      ->first();

        $this->renewal_fee = Prices::where('price_type', 'renewal')
                                   ->where('start_date', '<=', now())
                                   ->where(function($query) {
                                       $query->where('end_date', '>', now())
                                           ->orWhere('end_date', null);
                                   })
                                   ->orderBy('start_date')
                                   ->first();

        return view('livewire.pages.cpr.applicant-fees')
            ->layout('layouts.app');
    }
}
