<?php

namespace App\Livewire\Pages\Cpr;

use App\Mail\ApplicantInterviewNotification;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class AdminPreviewEmails extends Component
{
    public function render()
    {
        return view('livewire.pages.cpr.admin-preview-emails')
            ->layout('layouts.app');
    }
}
