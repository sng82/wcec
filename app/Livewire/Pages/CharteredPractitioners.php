<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class CharteredPractitioners extends Component
{
    public $title = "Chartered Practitioners";
    public $description = "Chartered Practitioners";

    public function render()
    {
        return view('livewire.pages.chartered-practitioners')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }

//    #[Title('WCEC : Chartered Practitioners')]
//
//    public function render()
//    {
//        return view('livewire.pages.chartered-practitioners');
//    }
}
