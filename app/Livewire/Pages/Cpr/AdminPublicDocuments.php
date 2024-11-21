<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\PublicDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Log;
use Psy\Readline\Hoa\Exception;

class AdminPublicDocuments extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $title = "Public Documents";
    public $documents;
    public $document_type;
    public $new_file;
    public $version;
    public $months;
    public $release_month;
    public $years;
    public $release_year;

    public function mount()
    {
        $this->documents = PublicDocument::all()->sortBy('order');
        $this->document_type = '';
        $this->release_month = strtoupper(date('M'));
        $this->months = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
        $this->release_year = date('Y');
        $this->years = range($this->release_year - 10, $this->release_year + 1);
    }

    public function rules(): array
    {
        return [
            'document_type' => 'required',
            'new_file'      => 'required|mimes:pdf,doc,docx,xls,xlsx',
            'version'       => 'required|numeric|min:1',
            'release_month' => 'required',
            'release_year'  => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'document_type.required' => 'Document To Replace is required.',
            'new_file.required'      => 'A new document is required.',
            'version.required'       => 'The version number is required.',
            'version.min'            => 'The version number must be at least 1.',
        ];
    }

    public function submit()
    {
//        dump($this->new_file->getClientOriginalName());
//        dump($this->new_file->getClientOriginalExtension());
//        dump($this->new_file);
//        dd();

        $this->validate();

        try {
            $doc_to_replace = PublicDocument::find($this->document_type);

            $this->deleteFile($doc_to_replace);

            $new_filename = str_replace(' ', '_', $this->new_file->getClientOriginalName());

            $this->new_file->storeAs(path: 'public/documents/', name: $new_filename);

            $doc_to_replace->update([
                'file_name'     => $new_filename,
                'version'       => $this->version,
                'release_month' => $this->release_month,
                'release_year'  => $this->release_year,
            ]);

            return $this->flash(
                'info',
                'Document Updated',
                [
                    'position'          => 'top-end',
                    'timer'             => 2000,
                    'showConfirmButton' => false,
                ],
                route('public-documents')
            );

        } catch (Exception $e) {

            Log::error('Error updating document | ' . $e->getMessage());

            $this->alert(
                'error',
                'Error updating document | ' . $e->getMessage(),
                [
                    'position'           => 'center',
                    'timer'              => null,
                    'showConfirmButton'  => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    public function deleteFile(PublicDocument $publicDocument): bool
    {
        if (!Auth::user()?->hasRole('admin')) {
            $this->alert('error', 'You do not have permission to replace or delete files', [
                'position'           => 'center',
                'timer'              => null,
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#dc2626',
            ]);

            return false;
        }

        $file_loc = 'public/documents/' .  $publicDocument->file_name;

//        Log::error('Temp | ' . $file_loc);

        if (storage::disk('local')->exists($file_loc)) {
            Storage::delete($file_loc);
            return true;
        }

        $this->alert('error', 'Unable to delete file', [
            'position'           => 'center',
            'timer'              => null,
            'showConfirmButton'  => true,
            'confirmButtonColor' => '#dc2626',
        ]);

        return false;
    }

    public function render()
    {
        return view('livewire.pages.cpr.admin-public-documents')
            ->layout('layouts.app');
    }
}
