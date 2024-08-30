<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
//use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Route;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    use LivewireAlert;

    public int $id = 0;
    public $registrant;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_main;
    public $phone_mobile;
    public $roles;
    public $registration_type;
    public $submission_count;
    public $submission_accepted_at;
    public $submission_accepted_by;
    public $became_registrant_at;
    public $registration_expires_at;
    public $declined_at;
    public $declined_by;
    public $created_at;

    public function messages()
    {
        return [
            'phone_main.phone' => 'The Phone (Main) field contains an invalid number',
            'phone_mobile.phone' => 'The Phone (Mobile) field contains an invalid number',
        ];
    }

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
                route('registrants')
//                'cpr/members'
            );
        }

        $this->first_name = $this->registrant->first_name;
        $this->last_name = $this->registrant->last_name;
        $this->email = $this->registrant->email;
        $this->phone_main = $this->registrant->phone_main;
        $this->phone_mobile = $this->registrant->phone_mobile;
        $this->roles = $this->registrant->getRoleNames();
        $this->submission_count = $this->registrant->submission_count;
        $this->registration_expires_at = $this->registrant->registration_expires_at?->format('Y-m-d');
    }

    public function update()
    {
        $this->validate([
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:2',
            'email'         => 'required|email',
            'phone_main'    => 'required|phone:GB',
            'phone_mobile'  => 'nullable|phone:GB,mobile',
        ]);

        try {
            $this->registrant->update([
                'first_name'   => trim($this->first_name),
                'last_name'    => trim($this->last_name),
                'email'        => trim(Str::of($this->email)->lower()),
                'phone_main'   => trim($this->phone_main),
                'phone_mobile' => trim($this->phone_mobile),
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
        return view('livewire.pages.cpr.user-edit')
            ->layout('layouts.app');
    }
}
