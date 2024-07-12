<?php

namespace App\Livewire\Pages;

use App\Models\Prices;
//use App\Models\User;
//use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class CharteredPractitioners extends Component
{
    use WithPagination;

    public $title = "Chartered Practitioners";
    public $description = "The Worshipful Company of Environmental Cleaners Chartered Practitioners Register (CPR)";
    public $current_registration_fee;
    public $current_submission_fee;

    public function getRegistrationFee()
    {
        $this->current_registration_fee = Prices::where('price_type', 'registration')
                                        ->where('start_date', '<=', now())
                                        ->where(function($query) {
                                            $query->where('end_date', '>', now())
                                                  ->orWhere('end_date', null);
                                        })
                                        ->orderBy('start_date')
                                        ->first();
    }

    public function getSubmissionFee()
    {
        $this->current_submission_fee = Prices::where('price_type', 'submission')
                                      ->where('start_date', '<=', now())
                                      ->where(function($query) {
                                          $query->where('end_date', '>', now())
                                                ->orWhere('end_date', null);
                                      })
                                      ->orderBy('start_date')
                                      ->first();
    }

    public function mount()
    {
        $this->getRegistrationFee();
        $this->getSubmissionFee();
    }

    public function render()
    {
        return view('livewire.pages.chartered-practitioners')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description,
                'current_registration_fee' => $this->current_registration_fee,
                'current_submission_fee' => $this->current_submission_fee,
            ]);
    }

}
