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

//    public $admins = '';
//    public $active_members = '';
//    public $lapsed_members = '';
//    public $applicants = '';
//    public $accepted_applicants = '';
//    public $blocked_applicants = '';


//    public function mount(): void
//    {
//        $this->active_members = User::with("roles")
//                                    ->whereHas("roles", function($query) {
//                                        $query->whereIn("name", ["member","lapsed member"]);
//                                    })->get();

//        $this->active_members = User::role('member')->orderBy('last_name')->get();

//        $this->all_members = User::with('roles')->with('acceptedBy')->get();

//        $this->admins = $this->all_members->filter(
//            fn ($user) => $user->roles->where('name', 'admin')->toArray()
//        )->sortBy('last_name');

//        $this->active_members = $this->all_members->filter(
//            fn ($user) => $user->roles->where('name', 'member')->toArray()
//        )->sortBy('last_name');

//        $this->lapsed_members = $this->all_members->filter(
//            fn ($user) => $user->roles->where('name', 'lapsed member')->toArray()
//        )->sortBy([
//            ['membership_expires_at', 'desc'],
//            ['last_name', 'asc']
//        ]);

//        $this->applicants = $this->all_members->filter(
//            fn ($user) => $user->roles->where('name', 'applicant')->toArray()
//        );

//        $this->accepted_applicants = $this->all_members->filter(
//            fn ($user) => $user->roles->where('name', 'accepted applicant')->toArray()
//        );

//        $this->accepted_applicants =

//        $this->blocked_applicants = $this->all_members->filter(
//            fn ($user) => $user->roles->where('name', 'blocked applicant')->toArray()
//        );
//    }


    public function render()
    {
        return view('livewire.pages.cpr.admin-members')
            ->layout('layouts.app');
    }
}
