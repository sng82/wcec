<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    public $title = "About";
    public $description = "About us";

    public function render()
    {
        return view('livewire.pages.about')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
//    #[Title('WCEC : About')]
//
//    public function render()
//    {
//        return view('livewire.pages.about');
//    }
}
