<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\SubmissionDate;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $title = "CPR Dashboard";
    public $nextSubmissionDate = '';
    public $nextSubmissionDateDifference = '';

    public $expiring_memberships = '';

    public function mount()
    {
        $nextSubmissionDate = SubmissionDate::where('submission_date', '>', now()->subDay())
                                            ->orderBy('submission_date', 'ASC')
                                            ->first()->submission_date;
//        $this->nextSubmissionDate = $nextSubmissionDate->format('d/m/Y');
        $this->nextSubmissionDate = Carbon::parse($nextSubmissionDate)->toFormattedDayDateString();

        $this->nextSubmissionDateDifference = Carbon::parse($nextSubmissionDate)->diffForHumans();

        $this->expiring_memberships = User::role('member')
                                          ->where('membership_expires_at', '>', now())
                                          ->where('membership_expires_at', '<', now()->addDays(30))
                                          ->orderBy('membership_expires_at', 'ASC')
                                          ->get();
    }

    public function render()
    {
//        $nextSubmissionDate = SubmissionDate::where('submission_date', '>', now()->subDay())
//                                            ->orderBy('submission_date', 'ASC')
//                                            ->first()->submission_date;

        return view('livewire.pages.cpr.dashboard')
            ->layout('layouts.app'
//                , [
//                'title' => $this->title,
//                'nextSubmissionDate' => $this->nextSubmissionDate,
//                'nextSubmissionDateDifference' => $this->nextSubmissionDateDifference,
//            ]
            );
    }
}
