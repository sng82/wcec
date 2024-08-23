<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Document;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class AdminPrivateDocuments extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    use WithPagination;

    public $title = "Private Documents";
//    public $documents;
    public $sort_column_name = 'doc_type';
    public $sort_column_direction = 'asc';
    public $search = '';
    public $filter = '';
    public $per_page = 10;
    public $filter_options;

    public function sortBy($column_name)
    {
        if ($this->sort_column_name === $column_name) {
            $this->sort_column_direction = $this->sort_column_direction === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sort_column_direction = 'asc';
        }
        $this->sort_column_name = $column_name;
    }

    public function filterFor($val)
    {
        $this->filter = $val;
    }

    public function searchFilter()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->filter_options = [
            '',
            'cpd',
            'cv',
            'job_description',
            'qualification_certificate',
            'qualification_proof',
            'submission',
            'training_certificate',
        ];
    }

    public function render()
    {
//        dd(Document::with('owner')
//                   ->search($this->search)
//                   ->where('doc_type', 'like', "%{$this->filter}%")
//                   ->orderBy($this->sort_column_name, $this->sort_column_direction));

        return view('livewire.pages.cpr.admin-private-documents', [
            'documents' => Document::with('owner')
                                   ->search($this->search)
                                   ->where('doc_type', 'like', "%{$this->filter}%")
                                   ->orderBy($this->sort_column_name, $this->sort_column_direction)
                                   ->paginate($this->per_page),
        ])->layout('layouts.app');
    }
}
