<?php

namespace App\Livewire\Component;

use App\Models\User;
use Livewire\Component;

class PendingApplicants extends Component
{
    public $sort_column_name = 'submission_fee_paid';
    public $sort_column_direction = 'desc';
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

    public function openMember($id)
    {
        $this->redirect('member-edit/' . $id);
    }

    public function render()
    {
        return view('livewire.component.pending-applicants', [
            'applicants' => User::role('applicant')
                                    ->search($this->search)
                                    ->orderBy($this->sort_column_name, $this->sort_column_direction)
                                    ->paginate($this->per_page),
//            'applicants' => User::role('applicant')
//                                ->where(function ($query) {
//                                    $query->where('first_name', 'like', '%' . $this->search . '%')
//                                          ->orWhere('last_name', 'like', '%' . $this->search . '%')
//                                          ->orWhere('email', 'like', '%' . $this->search . '%');
//                                })
//                                ->orderBy($this->sort_column_name, $this->sort_column_direction)
//                                ->get(),
        ]);
    }
}
