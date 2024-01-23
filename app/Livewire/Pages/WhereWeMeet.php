<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class WhereWeMeet extends Component
{
    public $title = "Where We Meet";
    public $description = "Where We Meet";

    public function render()
    {
        return view('livewire.pages.where-we-meet')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }

//    #[Title('WCEC : Where We Meet')]
//
//    public function render()
//    {
//        return view('livewire.pages.where-we-meet');
//    }
}
