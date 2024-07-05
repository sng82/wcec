<?php

namespace App\Livewire\Pages\Cpr;

use App;
use App\Models\Document;
use App\Models\EOI;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Route;
use Barryvdh\DomPDF\Facade\Pdf;

class AssessEoi extends Component
{
    use LivewireAlert;

    public $applicant;
    public $eoi;
    public $documents;
    public $eoi_status;
    public $feedback;
    public $notes;

    public function mount()
    {
        try {
            $id = Route::current()->parameter('id');
            $this->eoi = Eoi::find($id);
            $this->applicant = User::find($this->eoi->user_id);

            $this->feedback     = $this->eoi->feedback;
            $this->notes        = $this->eoi->notes;
            $this->documents    = $this->applicant->documents->sortBy('doc_type');
            $this->eoi_status   = $this->applicant->eoi_status;

        } catch (\Exception $e) {
            return $this->flash(
                'error',
                'Applicant not found',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                'cpr/members');
        }
    }

    public function buildPDF()
    {
        $obfuscation_key = rtrim(base64_encode($this->eoi->updated_at),"=");
        $file_loc = config('app.url').'/cpr/print-eoi/' . $this->eoi->id . '/' . $obfuscation_key;
        $html = file_get_contents($file_loc);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        $filename = 'EoI_' . $this->applicant->first_name . '_' . $this->applicant->last_name . '_' . Carbon::parse(now())->format('YmdHisu') . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $filename);
    }

    public function downloadFile(Document $document)
    {
        $file_loc = 'public/submitted_documents/' . $document->user_id . '/' . $document->file_name;
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

    public function downloadFiles()
    {
//        @todo
    }

    public function assess()
    {
        $this->eoi->update([
            'eoi_status' => $this->eoi_status,
            'feedback' => $this->feedback,
            'notes' => $this->notes,
        ]);
    }

    public function render()
    {
        return view('livewire.pages.cpr.assess-eoi')
            ->layout('layouts.app');
    }
}
