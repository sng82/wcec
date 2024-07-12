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
    public $registrant;
    public $first_name;
    public $last_name;
    public $email;
    public $role;
    public $registration_type;
//    public $roles;
//    public $submitted_at;
    public $submission_count;
    public $submission_accepted_at;
    public $submission_accepted_by;
    public $became_registrant_at;
    public $registration_expires_at;
    public $declined_at;
    public $declined_by;
    public $created_at;

    public function mount()
    {
        $id = Route::current()->parameter('id');
        $this->registrant = User::find($id);

        if (! $this->registrant) {
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
            $this->registrant->update([
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
        $this->first_name = $this->registrant->first_name;
        $this->last_name = $this->registrant->last_name;
        $this->email = $this->registrant->email;
        $this->role = $this->registrant->roles->pluck('name')[0] ?? '';
        $this->submission_count = $this->registrant->submission_count;
        $this->registration_expires_at = $this->registrant->registration_expires_at?->format('Y-m-d');

        return view('livewire.pages.cpr.member-edit')
            ->layout('layouts.app');
    }
}
