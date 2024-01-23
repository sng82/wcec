<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class History extends Component
{
    public $title = "Our History";
    public $description = "Our History";

    public function render()
    {
        return view('livewire.pages.history')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }
//    #[Title('WCEC : Our History')]
//
//    public $description = 'This is a description';
//
//    public function render()
//    {
//        return view('livewire.pages.history');
//    }
}
