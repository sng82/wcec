<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';


    public function mount()
    {
        // Prevent access if Chartered Practitioners Portal is switched off
        if (!Config::get('cpp.active')) {
            Redirect::to('/cpr-coming-soon');
        }
    }

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <h1 class="text-sky-900 text-2xl mb-4 border-b-4 border-red-700 pb-2">Reset Password</h1>
    <div class="mb-4 text-sm text-gray-600">
        <ul class="mb-3 ml-6 list-disc marker:text-red-700 space-y-2">
            <li class="text-sky-600">
                First login since the new Chartered Practitioners portal was launched?
            </li>
            <li class="text-sky-600">
                Forgot your password?
            </li>
        </ul>
        <p>
            No problem. Just let us know the email address you're registered with and we will email
            you a password reset link that will allow you to choose a new one.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Log in') }}
            </a>
            <x-primary-button  class="ms-3">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</div>
