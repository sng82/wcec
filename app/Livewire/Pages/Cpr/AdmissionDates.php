<?php

namespace App\Livewire\Pages\Cpr;

use Livewire\Component;

class AdmissionDates extends Component
{
//    public $title = "CPR Dashboard";

    public function render()
    {
        return view('livewire.pages.cpr.admission-dates')
            ->layout('layouts.app', [
//                'title' => $this->title,
            ]);
    }
}
