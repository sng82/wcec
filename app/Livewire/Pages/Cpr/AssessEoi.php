<?php

namespace App\Livewire\Pages\Cpr;

use App;
use App\Models\Document;
use App\Models\EOI;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Log;
use Route;
//use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;

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
            Log::error('Error loading EOI | ' . $e->getMessage());

            return $this->flash(
                'error',
                'Applicant not found',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                'cpr/dashboard');
        }
    }

    public function buildPDF()
    {
        $obfuscation_key = rtrim(base64_encode($this->eoi->updated_at),"=");
        $file_loc = config('app.url')
                    . '/cpr/print-eoi/'
                    . $this->eoi->id . '/'
                    . $obfuscation_key;
        $html = file_get_contents($file_loc);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        $filename = 'EoI_' . $this->applicant->first_name
                    . '_' . $this->applicant->last_name
                    . '_' . Carbon::parse(now())->format('YmdHisu')
                    . '.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, $filename);
    }

    public function downloadFile(Document $document)
    {
        $file_loc = 'public/submitted_documents/'
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

    public function downloadFiles()
    {
        try {
            $documents = Document::where('eoi_id', $this->eoi->id)->get();

            if (empty($documents)) {
                $this->alert(
                    'error',
                    'No Documents found',
                    [
                        'position'           => 'center',
                        'timer'              => null,
                        'showConfirmButton'  => true,
                        'confirmButtonColor' => '#dc2626',
                    ]
                );
                return false;
            }

            $zipFileName = 'EoI_Documents_'
                           . $this->eoi->user->first_name . '_'
                           . $this->eoi->user->last_name . '_'
                           . Carbon::parse(now())->format('YmdHisu')
                           . '.zip';

            $zip = new ZipArchive;
            $zip->open(public_path($zipFileName), ZipArchive::CREATE) === true;
            foreach ($documents as $document) {
                $zip->addFile(
                    storage_path(
                        'app/public/submitted_documents/'
                        . $this->eoi->user->id . '/'
                        . $document->file_name
                    ),
                    $document->file_name
                );
            }
            $zip->close();

            return response()
                ->download(public_path($zipFileName))
                ->deleteFileAfterSend();

        } catch (\Exception $e) {

            Log::error('Admin EoI Files download failed | ' . $e->getMessage());

            $err_message = 'Unable to download files';
            if (Config('app.env') !== 'Production') {
                $err_message = $e->getMessage();
            } else {
                Log::error($e->getMessage());
            }

            $this->alert(
                'error',
                $err_message,
                [
                    'position'           => 'center',
                    'timer'              => null,
                    'showConfirmButton'  => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
        return false;
    }

    public function assess()
    {
        try {
            $user = User::find($this->eoi->user_id);

            $this->eoi->update([
                'feedback' => $this->feedback,
                'notes' => $this->notes,
            ]);

            $user->update([
                'eoi_status' => $this->eoi_status,
            ]);

            $mail_sent = false;

            switch ($this->eoi_status) {
                case 'accepted':
                    Mail::to($user->email)->send(new App\Mail\ExpressionAccepted($user));
                    $mail_sent = true;
                    break;
                case 'unaccepted':
                    Mail::to($user->email)->send(new App\Mail\ExpressionUnaccepted($user, $this->eoi));
                    $mail_sent = true;
                    break;
                case 'rejected':
                    Mail::to($user->email)->send(new App\Mail\ExpressionRejected($user, $this->eoi));
                    $mail_sent = true;
                    break;
            }

            if ($mail_sent) {
                return $this->flash(
                    'success',
                    'Mail Sent To applicant',
                    [
                        'position' => 'top-end',
                        'timer' => 2000,
                        'showConfirmButton' => false,
                    ],
                    route('dashboard')
                );
            }
        } catch (\Exception $e) {
            Log::error('Admin EoI Sending Email failed | ' . $e->getMessage());
            return $this->flash(
                'error',
                'Mail NOT Sent To applicant',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                route('dashboard')
            );
        }

        return $this->flash(
            'success',
            'Expression of Interest saved successfully',
            [
                'position' => 'top-end',
                'timer' => 2000,
                'showConfirmButton' => false,
            ],
            route('dashboard')
        );
    }

    public function render()
    {
        return view('livewire.pages.cpr.assess-eoi')
            ->layout('layouts.app');
    }
}
