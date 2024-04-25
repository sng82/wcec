<?php

namespace App\Livewire\Pages;

//use Livewire\Attributes\Title;
use Livewire\Component;

class CharitableTrust extends Component
{
    public $title = "Charitable Trust";
    public $description = "The Worshipful Company of Environmental Cleaners Charitable Trust";

    public function render()
    {
        return view('livewire.pages.charitable-trust')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
}
