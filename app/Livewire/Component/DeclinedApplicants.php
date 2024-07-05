<?php

namespace App\Livewire\Component;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DeclinedApplicants extends Component
{
    use WithPagination;

    public $sort_column_name = 'declined_at';
    public $sort_column_direction = 'asc';
    public $search = '';
    public $per_page = 10;

    public function sortBy($column_name)
    {
        if ($this->sort_column_name === $column_name) {
            $this->sort_column_direction = $this->sort_column_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_column_direction = 'asc';
        }
        $this->sort_column_name = $column_name;
    }

//    public function openMember($id)
//    {
//        $this->redirect('member-edit/' . $id);
//    }

    public function render()
    {
        return view('livewire.component.declined-applicants', [
            'blocked_applicants' => User::role('blocked applicant')
                                        ->search($this->search)
                                        ->orderBy($this->sort_column_name, $this->sort_column_direction)
                                        ->paginate($this->per_page),
        ]);
    }
}
