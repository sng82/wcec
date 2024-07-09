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

class MemberAdd extends Component
{
    use LivewireAlert;

    public int $id = 0;
//    public $member;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_1;
    public $phone_2;
    public $phone_3;
    public $role;
    public $registration_fee_paid;
    public $application_fee_paid;
    public $send_email;
//    public $membership_type;
    public $roles;

    public function saveUser()
    {
//        dump($this->first_name);
//        dd($this->role);

        $this->validate([
            'first_name'    => 'required|min:2',
            'last_name'     => 'required|min:2',
            'email'         => 'required|email',
            'phone_1'       => 'nullable|numeric',
            'phone_2'       => 'nullable|numeric',
            'phone_3'       => 'nullable|numeric',
            'role'          => ['required', Rule::in(Role::get()->pluck('name'))],
        ]);

        try {

            $password = config('app.env') === 'production'
                ? Str::random(12)
                : 'wceccpr1';

            $new_user = User::create([
                'first_name'            => trim($this->first_name),
                'last_name'             => trim($this->last_name),
                'email'                 => trim(Str::of($this->email)->lower()),
                'phone_1'               => trim($this->phone_1),
                'phone_2'               => trim($this->phone_2),
                'phone_3'               => trim($this->phone_3),
                'registration_fee_paid' => $this->registration_fee_paid ? 1 : 0,
                'application_fee_paid'  => $this->application_fee_paid ? 1 : 0,
                'password'              => $password,
                'membership_expires_at' => $this->role === 'member' ? Carbon::parse(now())->addYear()->format('Y-m-d') : null,
                'accepted_at'           => $this->role === 'member' ? now() : null,
                'accepted_by'           => $this->role === 'member' ? auth()->user()->id : null,
                'became_member_at'      => $this->role === 'member' ? now() : null,
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
                'cpr/members'
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
