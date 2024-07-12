<?php

namespace App\Livewire\Pages\Cpr;

use Livewire\Component;

class SubmissionDates extends Component
{
//    public $title = "CPR Dashboard";

    public function render()
    {
        return view('livewire.pages.cpr.submission-dates')
            ->layout('layouts.app', [
//                'title' => $this->title,
            ]);
    }
}
