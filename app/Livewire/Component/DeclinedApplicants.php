<?php

namespace App\Livewire\Component;

use Livewire\Component;

class DeclinedApplicants extends Component
{
    public $blocked_applicants;

    public function mount($blocked_applicants)
    {
        $this->blocked_applicants = $blocked_applicants;
    }

    public function render()
    {
        return view('livewire.component.declined-applicants', [
            'blocked_applicants' => $this->blocked_applicants,
        ]);
    }
}
