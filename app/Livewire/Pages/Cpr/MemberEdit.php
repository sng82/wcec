<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
//use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Route;
use Spatie\Permission\Models\Role;

class MemberEdit extends Component
{
    use LivewireAlert;

    public int $id = 0;
    public $member;
    public $first_name;
    public $last_name;
    public $email;
    public $role;
    public $membership_type;
//    public $roles;
    public $submitted_at;
    public $submission_count;
    public $accepted_at;
    public $accepted_by;
    public $became_member_at;
    public $membership_expires_at;
    public $declined_at;
    public $declined_by;
    public $created_at;

    public function mount()
    {
        $id = Route::current()->parameter('id');
        $this->member = User::find($id);

        if (! $this->member) {
            return $this->flash(
                'error',
                'Member not found',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                'cpr/members');
        }
    }

    public function update()
    {
        $this->validate([
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:2',
            'email'         => 'required|email',
        ]);

        try {
            $this->member->update([
                'first_name'   => trim($this->first_name),
                'last_name'    => trim($this->last_name),
                'email'        => trim(Str::of($this->email)->lower()),
            ]);

            $this->alert('info', 'Member updated successfully', [
                'position' => 'top-end',
                'timer' => 2000,
                'toast' => true,
                'showConfirmButton' => false,
                'confirmButtonColor' => '#06b6d4',
            ]);

        } catch(\Exception $e) {
            $this->alert('error', 'Unable to update. ' . $e->getMessage(), [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }


    public function render()
    {
        $this->first_name = $this->member->first_name;
        $this->last_name = $this->member->last_name;
        $this->email = $this->member->email;
        $this->role = $this->member->roles->pluck('id')[0] ?? '';
//        $this->membership_type = $this->member->roles->pluck('name')[0] ?? '';
//        $this->roles = Role::get();

//        $this->submitted_at = $this->member->submitted_at?->format('Y-m-d H:i:s');
        $this->submission_count = $this->member->submission_count;
//        $this->accepted_at = $this->member->accepted_at?->format('Y-m-d H:i:s');
//        $this->accepted_by = $this->member->accepted_by;
//        $this->became_member_at = $this->member->became_member_at?->format('Y-m-d');
        $this->membership_expires_at = $this->member->membership_expires_at?->format('Y-m-d');
//        $this->declined_at = $this->member->declined_at?->format('Y-m-d H:i:s');
//        $this->declined_by = $this->member->declined_by;
//        $this->created_at = $this->member->created_at?->format('Y-m-d H:i:s');

        return view('livewire.pages.cpr.member-edit')->layout('layouts.app');
    }
}
