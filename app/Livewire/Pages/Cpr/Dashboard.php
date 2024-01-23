<?php

namespace App\Livewire\Pages\Cpr;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = "CPR Dashboard";

    public function render()
    {
        return view('livewire.pages.cpr.dashboard')
            ->layout('layouts.app', [
                'title' => $this->title,
            ]);
    }
}
