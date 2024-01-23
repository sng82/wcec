<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Membership extends Component
{
    public $title = "Membership";
    public $description = "Description of the membership page";

    public function render()
    {
        return view('livewire.pages.membership')
            ->layout('layouts.front', [
                'title' => $this->title,
                'description' => $this->description
            ]);
    }

//    #[Title('WCEC : Membership')]
//
//    public function render()
//    {
//        return view('livewire.pages.membership');
//    }
}
