<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
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

    public function mount()
    {
        // Start with an empty option. This is used when no filtering is being applied...
        $filter_options = [''];

        // ... then add each unique document type that is found within the system
        $filter_options2 = Document::select('doc_type')
                                   ->distinct()
                                   ->orderBy('doc_type')
                                   ->pluck('doc_type')
                                   ->toArray();

        $this->filter_options = array_merge($filter_options, $filter_options2);
    }

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

    public function downloadFile(Document $document)
    {
        //        $file_loc = 'public/submitted_documents/'
        $file_loc = 'private/submitted_documents/'
                    . $document->user_id . '/'
                    . $document->file_name;
        if (Storage::disk('local')->exists($file_loc)) {
            return Storage::download($file_loc);
        }
        $this->alert(
            'error',
            'Error',
            [
                'position'           => 'center',
                'timer'              => null,
                'text'               => 'Unable to download file. It has probably been deleted.',
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#dc2626',
            ]
        );
    }

    public function render()
    {
        return view('livewire.pages.cpr.admin-private-documents', [
            'documents' => Document::with('owner')
                                   ->search($this->search)
                                   ->where('doc_type', 'like', "%{$this->filter}%")
                                   ->orderBy($this->sort_column_name, $this->sort_column_direction)
                                   ->paginate($this->per_page),
        ])->layout('layouts.app');
    }
}
