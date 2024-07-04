<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\EOI;
use App\Models\User;
use Livewire\Component;
use Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PrintEoi extends Component
{
    public $applicant;
    public $eoi;

    public function mount()
    {
        $id = Route::current()->parameter('id');
        $obfuscation_key = Route::current()->parameter('obfuscation_key') . '==';

        $this->eoi = EOI::where('id', $id)
                        ->where('updated_at', base64_decode($obfuscation_key))
                        ->first();

        if (! $this->eoi) {
            throw new NotFoundHttpException();
        }

        $this->applicant = User::find($this->eoi->user_id);

        if (! $this->applicant) {
            throw new NotFoundHttpException();
        }

    }

    public function render()
    {
        return view('livewire.pages.cpr.print-eoi')
            ->layout('layouts.bare');
    }
}
