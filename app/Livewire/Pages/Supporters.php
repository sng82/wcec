<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Supporters extends Component
{
    public $title = "Our Supporters";
    public $description = "Our Supporters";

    public function render()
    {
        return view('livewire.pages.supporters')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }

//    #[Title('WCEC : Our Supporters')]
//
//    public function render()
//    {
//        return view('livewire.pages.supporters');
//    }
}
