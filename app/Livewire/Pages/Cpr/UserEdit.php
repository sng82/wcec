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
                'User not found',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                route('registrants')
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
        $this->became_registrant_at = $this->registrant->became_registrant_at?->format('Y-m-d');
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

            $this->alert(
                'info',
                'User updated successfully',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#06b6d4',
                ]
            );

        } catch(\Exception $e) {
            $this->alert('error',
                'Unable to update. ' . $e->getMessage(),
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    public function setLapsed()
    {
        try {
            $this->registrant->removeRole('registrant');
            $this->registrant->assignRole('lapsed registrant');

            return $this->flash(
                'info',
                'User demoted',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#06b6d4',
                ],
                route('user-edit', [$this->registrant->id])
            );

        } catch (\Exception $e) {
            $this->alert(
                'error',
                'Unable to demote. ' . $e->getMessage(),
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    public function setActive()
    {
        try {
            $this->registrant->removeRole('lapsed registrant');
            $this->registrant->assignRole('registrant');

            return $this->flash(
                'info',
                'User promoted',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#06b6d4',
                ],
                route('user-edit', [$this->registrant->id])
            );

        } catch (\Exception $e) {
            $this->alert(
                'error',
                'Unable to promote. ' . $e->getMessage(),
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    public function setApplicant()
    {
        try {
            $this->registrant->update([
                'registration_fee_paid'     => 0,
                'eoi_status'                => null,
                'submission_count'          => 0,
                'submission_fee_paid'       => 0,
                'submission_status'         => null,
                'submission_interview_at'   => null,
                'submission_accepted_at'    => null,
                'submission_accepted_by'    => null,
                'registration_pathway'      => null,
                'became_registrant_at'      => null,
                'cpd_last_submitted_at'     => null,
                'renewal_fee_last_paid_at'  => null,
                'registration_expires_at'   => null,
                'declined_at'               => null,
                'declined_by'               => null,
            ]);

            $this->registrant->removeRole('lapsed registrant');
            $this->registrant->assignRole('applicant');

            return $this->flash(
                'info',
                'User reset to Applicant status',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#06b6d4',
                ],
                route('user-edit', [$this->registrant->id])
            );

        } catch (\Exception $e) {
            $this->alert(
                'error',
                'Unable to reset account. ' . $e->getMessage(),
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    public function render()
    {
        return view('livewire.pages.cpr.user-edit')
            ->layout('layouts.app');
    }
}
