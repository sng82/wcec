<?php

namespace App\Livewire\Component;

use Livewire\Component;

class PendingApplicants extends Component
{
    public $applicants;

    public function mount($applicants)
    {
        $this->applicants = $applicants;
    }

    public function render()
    {
        return view('livewire.component.pending-applicants', [
            'applicants' => $this->applicants,
        ]);
    }
}
