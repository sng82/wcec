<?php

namespace App\Livewire\Modals\WhyJoin;

use LivewireUI\Modal\ModalComponent;

class ChrisLuxton extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        // 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
        return '7xl';
    }

    public function render()
    {
        return view('livewire.modals.why-join.chris-luxton');
    }
}
