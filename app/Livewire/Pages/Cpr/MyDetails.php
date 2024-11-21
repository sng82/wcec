<?php

namespace App\Livewire\Pages\Cpr;

use Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MyDetails extends Component
{
    use LivewireAlert;

    public $user;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_main;
    public $phone_mobile;
    public $roles;

    public function messages()
    {
        return [
            'phone_main.phone' => 'The Phone (Main) field contains an invalid number',
            'phone_mobile.phone' => 'The Phone (Mobile) field contains an invalid number',
        ];
    }

    public function mount()
    {
        $this->user         = Auth::user();
        $this->first_name   = $this->user->first_name;
        $this->last_name    = $this->user->last_name;
        $this->email        = $this->user->email;
        $this->phone_main   = $this->user->phone_main;
        $this->phone_mobile = $this->user->phone_mobile;
        $this->roles        = $this->user->getRoleNames();
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
            $this->user->update([
                'first_name'   => $this->first_name,
                'last_name'    => $this->last_name,
                'email'        => $this->email,
                'phone_main'   => $this->phone_main,
                'phone_mobile' => $this->phone_mobile,
            ]);

            $this->alert(
                'info',
                'Record updated successfully',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'toast' => true,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#06b6d4',
                ]
            );
        } catch (\Exception $e) {
            $this->alert(
                'error',
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

    public function render()
    {
        return view('livewire.pages.cpr.my-details')
            ->layout('layouts.app');
    }
}
