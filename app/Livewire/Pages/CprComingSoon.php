<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class CprComingSoon extends Component
{
    public $title = "CPR Portal Coming Soon";
    public $description = "The Worshipful Company of Environmental Cleaners Chartered Practitioners Portal Coming Soon";

    public function render()
    {
        return view('livewire.pages.cpr-coming-soon')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
}
