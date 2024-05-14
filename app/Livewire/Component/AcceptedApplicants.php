<?php

namespace App\Livewire\Component;

use Livewire\Component;

class AcceptedApplicants extends Component
{
    public $accepted_applicants;

    public function mount($accepted_applicants)
    {
        $this->accepted_applicants = $accepted_applicants;
    }

    public function render()
    {
        return view('livewire.component.accepted-applicants', [
            'accepted_applicants' => $this->accepted_applicants,
        ]);
    }
}
