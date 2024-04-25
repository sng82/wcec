<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\SubmissionDate;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $title = "CPR Dashboard";
    public $nextSubmissionDate = '';
    public $nextSubmissionDateDifference = '';



    public function mount()
    {
        $nextSubmissionDate = SubmissionDate::where('submission_date', '>', now()->subDay())
                                            ->orderBy('submission_date', 'ASC')
                                            ->first()->submission_date;
//        $this->nextSubmissionDate = $nextSubmissionDate->format('d/m/Y');
        $this->nextSubmissionDate = Carbon::parse($nextSubmissionDate)->toFormattedDayDateString();

        $this->nextSubmissionDateDifference = Carbon::parse($nextSubmissionDate)->diffForHumans();
    }

    public function render()
    {
//        $nextSubmissionDate = SubmissionDate::where('submission_date', '>', now()->subDay())
//                                            ->orderBy('submission_date', 'ASC')
//                                            ->first()->submission_date;

        return view('livewire.pages.cpr.dashboard')
            ->layout('layouts.app', [
                'title' => $this->title,
                'nextSubmissionDate' => $this->nextSubmissionDate,
                'nextSubmissionDateDifference' => $this->nextSubmissionDateDifference,
            ]);
    }
}
