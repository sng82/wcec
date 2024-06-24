<?php

namespace App\Livewire\Pages\Cpr;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\User;

class AdminMembers extends Component
{
    use LivewireAlert;

    public $title = "CPR Admin Prices";
//    public $all_members = '';

    public $active_member_count = '';
    public $lapsed_member_count = '';
    public $pending_applicant_count = '';
    public $pending_eoi_submitted_count = '';
    public $pending_waiting_approval_count = '';
    public $accepted_applicant_count = '';
    public $blocked_applicant_count = '';

    public function openMember($id)
    {
        $this->redirect('member-add');
    }

    public function addMember()
    {
        $this->redirect('member-add');
    }

    public function render()
    {
        $this->active_member_count = User::role('member')->count();
        $this->lapsed_member_count = User::role('lapsed member')->count();
        $this->accepted_applicant_count = User::role('accepted applicant')->count();

        $this->pending_eoi_submitted_count = User::role('applicant')
                                                 ->where('registration_fee_paid', true)
                                                 ->where('eoi_status', 'submitted')
                                                 ->count() ?? 0;

        $this->pending_waiting_approval_count = User::role('applicant')
                                                    ->where('registration_fee_paid', true)
                                                    ->where('application_fee_paid', true)
                                                    ->where('application_status', 'submitted')
                                                    ->count() ?? 0;
        $this->pending_applicant_count = User::role('applicant')->count();
        $this->blocked_applicant_count = User::role('blocked applicant')->count();

        return view('livewire.pages.cpr.admin-members')
            ->layout('layouts.app');
    }
}
