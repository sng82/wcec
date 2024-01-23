<?php

namespace App\Livewire\Pages;

use App\Mail\Contact as ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $title = "Contact Us";
    public $description = "Contact Us";

    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';


    public function submit()
    {
        $validated = $this->validate([
            'name'      => 'required|min:2',
            'email'     => 'required|email',
            'phone'     => 'required|min:9',
            'message'   => 'required|min:10',
        ]);

        Mail::to(Config('mail.contact_mail_recipient'))
            ->send(new ContactMail($validated));

        return redirect('/contact')
            ->with('status', 'sent');
    }

    public function render()
    {
        return view('livewire.pages.contact')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
}
