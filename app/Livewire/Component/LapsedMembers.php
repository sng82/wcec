<?php

namespace App\Livewire\Component;

use Livewire\Component;

class LapsedMembers extends Component
{
    public $lapsed_members;

    public function mount($lapsed_members)
    {
        $this->lapsed_members = $lapsed_members;
    }

    public function render()
    {
        return view('livewire.component.lapsed-members', [
            'lapsed_members' => $this->lapsed_members,
        ]);
    }
}
