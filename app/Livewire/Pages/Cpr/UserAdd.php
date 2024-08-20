<?php

namespace App\Livewire\Pages\Cpr;

use App\Mail\NewUserLoginInstructions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserAdd extends Component
{
    use LivewireAlert;

    public int $id = 0;
//    public $registrant;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_main;
    public $phone_mobile;
    public $role;
    public $registration_fee_paid;
    public $submission_fee_paid;
    public $send_email;
//    public $registration_type;
    public $roles;

    public function saveUser()
    {
//        dump($this->first_name);
//        dd($this->role);

        $this->validate([
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:2',
            'email'         => 'required|email',
            'phone_main'    => 'nullable|numeric',
            'phone_mobile'  => 'nullable|numeric',
            'role'          => ['required', Rule::in(Role::get()->pluck('name'))],
        ]);

        try {

            $password = config('app.env') === 'production'
                ? Str::random(12)
                : 'wceccpr1';

            $new_user = User::create([
                'first_name'                => trim($this->first_name),
                'last_name'                 => trim($this->last_name),
                'email'                     => trim(Str::of($this->email)->lower()),
                'phone_main'                => trim($this->phone_main),
                'phone_mobile'              => trim($this->phone_mobile),
                'registration_fee_paid'     => $this->registration_fee_paid ? 1 : 0,
                'submission_fee_paid'       => $this->submission_fee_paid ? 1 : 0,
                'password'                  => $password,
                'registration_expires_at'   => $this->role === 'registrant' ? Carbon::parse(now())->addYear()->format('Y-m-d') : null,
                'submission_accepted_at'    => $this->role === 'registrant' ? now() : null,
                'submission_accepted_by'               => $this->role === 'registrant' ? auth()->user()->id : null,
                'became_registrant_at'      => $this->role === 'registrant' ? now() : null,
            ]);

            $new_user->assignRole($this->role);

            if ($this->send_email) {
                Mail::to($new_user->email)->send(new NewUserLoginInstructions($new_user));
            }

            return $this->flash(
                'success',
                'User added successfully',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ],
//                'cpr/members'
                route('registrants')
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
        return view('livewire.pages.cpr.user-add')->layout('layouts.app');
    }
}
