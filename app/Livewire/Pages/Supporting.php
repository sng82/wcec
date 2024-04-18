<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Supporting extends Component
{
    public $title = "Supporting Others";
    public $description = "The Worshipful Company of Environmental Cleaners - Supporting Others";

    public function render()
    {
        return view('livewire.pages.supporting')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }

//    #[Title('WCEC : Supporting Others')]
//
//    public function render()
//    {
//        return view('livewire.pages.supporting');
//    }
}
