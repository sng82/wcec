<?php

namespace App\Livewire\Pages\Cpr;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;

class MemberAdd extends Component
{
    use LivewireAlert;

    public int $id = 0;
//    public $member;
    public $first_name;
    public $last_name;
    public $email;
    public $role;
    public $eoi_fee_paid;
    public $submission_fee_paid;
    public $send_email;
//    public $membership_type;
    public $roles;

    public function save()
    {
        $this->validate([
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:2',
            'email'         => 'required|email',
            'role'          => ['required', Rule::in(Role::get()->pluck('name'))],
        ]);

        try {
            $new_user = User::create([
                'first_name'            => trim($this->first_name),
                'last_name'             => trim($this->last_name),
                'email'                 => trim(Str::of($this->email)->lower()),
                'eoi_fee_paid'          => $this->eoi_fee_paid ? 1 : 0,
                'submission_fee_paid'   => $this->submission_fee_paid ? 1 : 0,
                'password'              => Str::random(12),
                'membership_expires_at' => $this->role === 'member' ? Carbon::parse(now())->addYear()->format('Y-m-d') : null,
                'accepted_at'           => $this->role === 'member' ? now() : null,
                'accepted_by'           => $this->role === 'member' ? auth()->user()->id : null,
                'became_member_at'      => $this->role === 'member' ? now() : null,
            ]);

            $new_user->assignRole($this->role);

            //@todo: send email if option selected

            return $this->flash(
                'info', 'User added successfully', [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ], 'cpr/members'
            );

//            $this->alert('info', 'User added successfully', [
//                'position' => 'top-end',
//                'timer' => 2000,
//                'toast' => true,
//                'showConfirmButton' => false,
//                'confirmButtonColor' => '#06b6d4',
//            ]);
        } catch (\Exception $e) {
            $this->alert('error', 'Unable to create. ' . $e->getMessage(), [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }


    }

    public function render()
    {
        $this->send_email = true;
//        $this->roles = Role::get()->pluck('name', 'name')->toArray();
        return view('livewire.pages.cpr.member-add')->layout('layouts.app');
    }
}