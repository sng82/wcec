<?php

namespace App\Livewire\Component;

use Livewire\Component;
use App\Models\User;

class ActiveMembers extends Component
{

    public $sort_column_name = 'membership_expires_at';
    public $sort_column_direction = 'asc';

    public function sortBy($column_name)
    {
        if ($this->sort_column_name === $column_name) {
            $this->sort_column_direction = $this->sort_column_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_column_direction = 'asc';
        }
        $this->sort_column_name = $column_name;
    }

    public function render()
    {
        return view('livewire.component.active-members', [
            'active_members' => User::role('member')
                                    ->orderBy($this->sort_column_name, $this->sort_column_direction)
                                    ->get(),
        ]);
    }
}
