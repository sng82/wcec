<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\User;
use Livewire\Component;
use Route;

class AssessEoi extends Component
{
    public $applicant;
    public $eoi;
    public $documents;

    public function mount()
    {
        $id = Route::current()->parameter('id');
        $this->applicant = User::find($id);

        if (! $this->applicant) {
            return $this->flash(
                'error',
                'Member not found',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                'cpr/members');
        }

        $this->eoi = $this->applicant->eoi;
        $this->documents = $this->applicant->documents;
    }

    public function downloadFile()
    {

    }

    public function downloadFiles()
    {

    }

    public function render()
    {
        return view('livewire.pages.cpr.assess-eoi')
            ->layout('layouts.app');
    }
}
