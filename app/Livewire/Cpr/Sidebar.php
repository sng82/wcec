<?php

namespace App\Livewire\Cpr;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class Sidebar extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.cpr.sidebar');
    }
}
