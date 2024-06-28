<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\EOI;
use App\Models\User;
use Livewire\Component;
use Route;

class PrintEoi extends Component
{
    public $applicant;
    public $eoi;

    public function mount()
    {
        $id = Route::current()->parameter('id');
        $this->eoi = EOI::find($id);
        $this->applicant = User::find($this->eoi->user_id);

//        if (! $this->applicant) {
//            return $this->flash(
//                'error',
//                'Member not found',
//                [
//                    'position' => 'center',
//                    'timer' => null,
//                    'showConfirmButton' => true,
//                    'confirmButtonColor' => '#dc2626',
//                ],
//                'cpr/members');
//        }
//
//        $this->eoi = $this->applicant->eoi;
    }

    public function render()
    {
        return view('livewire.pages.cpr.print-eoi')->layout('layouts.bare');
    }
}
