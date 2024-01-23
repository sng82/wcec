<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class CharitableTrust extends Component
{
    public $title = "Charitable Trust";
    public $description = "About our charitable trust";

    public function render()
    {
        return view('livewire.pages.charitable-trust')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
//    #[Title('WCEC : Charitable Trust')]
//
//    public function render()
//    {
//        return view('livewire.pages.charitable-trust');
//    }
}
