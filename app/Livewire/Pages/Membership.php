<?php

namespace App\Livewire\Pages;

use App\Mail\MembershipEnquiry as MembershipEnquiryMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;

class Membership extends Component
{
    use UsesSpamProtection;

    public $title = "Membership";
    public $description = "Membership of the Worshipful Company of Environmental Cleaners";

    public $name = '';
    public $email = '';
    public $detail = '';

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
            'detail'    => 'required|min:10',
        ]);

        Mail::to(config('mail.membership_enquiry_mail_recipient'))
            ->send(new MembershipEnquiryMail($validated));

        session()->flash('status', 'sent');

//        $this->redirect('/registration#enquiry', navigate: true);

//        return redirect('/registration#enquiry')
//            ->with('status', 'sent')
//            ;
    }

    public function render()
    {
        return view('livewire.pages.membership')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }

//    #[Title('WCEC : Membership')]
//
//    public function render()
//    {
//        return view('livewire.pages.membership');
//    }
}
