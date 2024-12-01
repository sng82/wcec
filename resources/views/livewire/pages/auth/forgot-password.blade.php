<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';
    public string $feedback_message = '';


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

//        if ($status != Password::RESET_LINK_SENT) {
//            $this->addError('email', __($status));
//
//            return;
//        }

        $this->reset('email');

//        session()->flash('status', __($status));
        $this->feedback_message = "We've checked for an account using this email address. If one was found, an email containing further instructions has been sent to it.";
    }
}; ?>

<div>
    <h1 class="text-sky-900 text-2xl mb-4 border-b-4 border-red-700 pb-2">Reset Password</h1>
    <div class="mb-4 text-sm text-gray-600">
        <ul class="mb-3 ml-6 list-disc marker:text-red-700 space-y-2">
            <li class="text-sky-600">
                Forgot your password?
            </li>
            <li class="text-sky-600">
                Haven't logged in since the new Chartered Practitioners portal was launched?
            </li>
            <li class="text-sky-600">
                An account was created for you and you've received an email asking you to set a password?
            </li>
        </ul>
        <p>
            No problem. If any of the above are true, just let us know the email address you're registered with and we will email
            you a link to set a new password.
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

            {!! $this->feedback_message !== '' ? "<p class='mt-3 text-sky-600 text-sm'>" . $this->feedback_message . '</p>' : '' !!}
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button  class="ms-3">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
        <hr class="mt-4">
        <div class="flex items-center justify-between mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Log in') }}
            </a>
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500" href="{{ route('register') }}" wire:navigate>
                {{ __('Register') }}
            </a>
        </div>
    </form>
</div>
