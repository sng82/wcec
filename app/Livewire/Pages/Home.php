<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{

    public $title = "The Worshipful Company of Environmental Cleaners";
    public $description = "The Worshipful Company of Environmental Cleaners";

    public function render()
    {
        return view('livewire.pages.home')
//            ->with('title', $this->title)
//            ->with('description', $this->description)
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
}
