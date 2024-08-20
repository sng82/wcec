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

    public $active_registrant_count = '';
    public $lapsed_registrant_count = '';
    public $pending_applicant_count = '';
    public $pending_eoi_submitted_count = '';
    public $pending_waiting_approval_count = '';
    public $accepted_applicant_count = '';
    public $blocked_applicant_count = '';

//    public function openMember($id)
//    {
//        $this->redirect('user-add');
//    }

    public function addMember()
    {
        $this->redirect('user-add');
    }

    public function mount()
    {
        $this->getCounts();
    }

    public function getCounts()
    {
        $this->active_registrant_count = User::role('registrant')->count();
        $this->lapsed_registrant_count = User::role('lapsed registrant')->count();
        $this->accepted_applicant_count = User::role('accepted applicant')->count();

        $this->pending_eoi_submitted_count = User::role('applicant')
                                                 ->where('registration_fee_paid', true)
                                                 ->where('eoi_status', 'submitted')
                                                 ->count() ?? 0;

        $this->pending_waiting_approval_count = User::role('applicant')
                                                    ->where('registration_fee_paid', true)
                                                    ->where('submission_fee_paid', true)
                                                    ->where('submission_status', 'submitted')
                                                    ->count() ?? 0;
        $this->pending_applicant_count = User::role('applicant')->count();
        $this->blocked_applicant_count = User::role('blocked applicant')->count();
    }

    public function render()
    {
        return view('livewire.pages.cpr.admin-members')
            ->layout('layouts.app');
    }
}
