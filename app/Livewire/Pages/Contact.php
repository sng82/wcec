<?php

namespace App\Livewire\Pages;

use App\Mail\Contact as ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;

class Contact extends Component
{
    use UsesSpamProtection;

    public $title = "ContactController Us";
    public $description = "ContactController The Worshipful Company of Environmental Cleaners";

    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';

    public HoneypotData $extraFields;

    public function mount()
    {
        $this->extraFields = new HoneypotData();
    }

    public function submit()
    {
        $this->protectAgainstSpam();

        $validated = $this->validate([
            'name'      => 'required|min:2',
            'email'     => 'required|email',
            'phone'     => 'required|min:9',
            'message'   => 'required|min:10',
        ]);

        Mail::to(Config('mail.contact_mail_recipient'))
            ->send(new ContactMail($validated));

        session()->flash('status', 'sent');

//        return redirect('/contact')
//            ->with('status', 'sent');
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
