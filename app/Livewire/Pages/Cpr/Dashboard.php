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

        $this->nextSubmissionDate = Carbon::parse($nextSubmissionDate)->toFormattedDayDateString();

        $this->nextSubmissionDateDifference = Carbon::parse($nextSubmissionDate)->diffForHumans();

        $this->expiring_memberships = User::role('member')
                                          ->where('membership_expires_at', '>', now())
                                          ->where('membership_expires_at', '<', now()->addDays(30))
                                          ->orderBy('membership_expires_at', 'ASC')
                                          ->get();
    }

    public function openMember($id)
    {
        $this->redirect('member-edit/' . $id);
    }

    public function render()
    {
        return view('livewire.pages.cpr.dashboard')
            ->layout('layouts.app');
    }
}
