<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Officers extends Component
{
    public $title = "Officers";
    public $description = "Officers";

    public function render()
    {
        return view('livewire.pages.officers')
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
