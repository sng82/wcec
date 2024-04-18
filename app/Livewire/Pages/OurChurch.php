<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class OurChurch extends Component
{
    public $title = "Our Church";
    public $description = "The Church of The Worshipful Company of Environmental Cleaners";

    public function render()
    {
        return view('livewire.pages.our-church')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
//    #[Title('WCEC : Our Church')]
//
//    public function render()
//    {
//        return view('livewire.pages.our-church');
//    }
}
