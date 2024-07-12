<?php

namespace App\Livewire\Component;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class PublicRegistrants extends Component
{
    use withPagination;

    public $sort_column_name = 'became_registrant_at';
    public $sort_column_direction = 'asc';
    public $search = '';
    public $per_page = 12;

    public function sortBy($column_name)
    {
        if ($this->sort_column_name === $column_name) {
            $this->sort_column_direction = $this->sort_column_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_column_direction = 'asc';
        }
        $this->sort_column_name = $column_name;
    }

    public function searchFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.component.public-registrants', [

            'registrants' => User::select(['id', 'first_name', 'last_name', 'submission_accepted_at'])
                                ->role('registrant')
                                ->publicSearch($this->search)
                                ->orderBy($this->sort_column_name, $this->sort_column_direction)
                                ->paginate($this->per_page),
        ]);
    }
}
