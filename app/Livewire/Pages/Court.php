<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Court extends Component
{
    public $title = "The Court & Office";
    public $description = "The Court and Office";

    public function render()
    {
        return view('livewire.pages.court')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }

//    #[Title('WCEC : The Court &amp; Office')]
//
//    public function render()
//    {
//        return view('livewire.pages.court');
//    }
}
