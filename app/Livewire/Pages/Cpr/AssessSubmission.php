<?php

namespace App\Livewire\Pages\Cpr;

use App\Mail\ApplicantInterviewNotification;
use App\Models\Document;
use App\Models\Submission;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Log;
use ZipArchive;

class AssessSubmission extends Component
{
    use LivewireAlert;

    public $applicant;
    public $submission_document;
    public $qualification_proof;
    public $submission_status;
    public $submission_interview_at;
    public $path;
    public $feedback;
    public $notes;
    public $submission;
    public $send_interview_email = false;

    public function mount()
    {
        try {
            $id = \Route::current()->parameter('id');
            $this->applicant                = User::find($id);
            $this->path                     = $this->applicant->registration_pathway;

            if ($this->path === 'individual') {
                $this->submission_document = Document::where('user_id', $id)
                                                     ->where('doc_type', 'submission')
                                                     ->orderBy('id', 'DESC')
                                                     ->first();
            } else {
                $this->qualification_proof = Document::where('user_id', $id)
                                                     ->where('doc_type', 'qualification_proof')
                                                     ->get();
            }

            $this->submission_status        = $this->applicant->submission_status;
            $this->submission_interview_at  = !empty($this->applicant->submission_interview_at ?: '')
                                                ? Carbon::parse($this->applicant->submission_interview_at)->format('Y-m-d\TH:i:s')
                                                : null;
            $this->submission               = $this->applicant->submission;

            if ($this->submission){
                $this->feedback = $this->submission->feedback;
                $this->notes    = $this->submission->notes;
            }

        } catch (Exception $e) {
            Log::error('Error loading Submission | ' . $e->getMessage());

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

    public function downloadFile()
    {
        try {
            if ($this->path === 'individual') {
                $file_loc = 'private/submitted_documents/'
                            . $this->submission_document->user_id . '/'
                            . $this->submission_document->file_name;
                if (Storage::disk('local')->exists($file_loc)) {
                    return Storage::download($file_loc);
                }
            } elseif ($this->path === 'standard') {
                $zip         = new ZipArchive;
                $zip_file_name = str_replace(' ', '_', $this->applicant->first_name) . '_'
                                 . str_replace(' ', '_', $this->applicant->last_name) . '_'
                                 . 'Qualification_Proof_'
                                 . Carbon::parse(now())->format('YmdHisu')
                                 . '.zip';

                $zip_loc = 'app/private/submitted_documents/'
                           . $this->applicant->id . '/'
                           . $zip_file_name;

                if ($zip->open(storage_path($zip_loc), ZipArchive::CREATE) === TRUE) {
                    $documents = Document::where('user_id', $this->applicant->id)
                                         ->where('doc_type', 'qualification_proof')
                                         ->get();

                    foreach ($documents as $document) {
                        $zip->addFile(
                            storage_path(
                                'app/private/submitted_documents/'
                                . $this->applicant->id . '/'
                                . $document->file_name
                            ),
                            $document->file_name
                        );
                    }
                    $zip->close();
                    return response()->download(storage_path($zip_loc))->deleteFileAfterSend();
                }
                Log::error('Error creating/opening ZIP file');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());

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
    }

    public function save()
    {
        try {
            $this->submission = Submission::updateOrCreate([
                'user_id' => $this->applicant->id,
            ], [
                'user_id'   => $this->applicant->id,
                'feedback'  => $this->feedback,
                'notes'     => $this->notes,
            ]);

            $applicant = $this->applicant;
            $applicant->submission_status = $this->submission_status;
            $applicant->submission_interview_at = $this->submission_interview_at !== ''
                                                    ? $this->submission_interview_at
                                                    : null;

//            $applicant_data = [];
//            $applicant_data['submission_status']        = $this->submission_status;
//            $applicant_data['submission_interview_at']  = $this->submission_interview_at !== ''
//                                                                ? $this->submission_interview_at
//                                                                : null;

            if ($this->submission_status === 'accepted') {

                $applicant->removeRole('applicant');
                $applicant->assignRole('accepted applicant');

                if (
                    empty($this->applicant->submission_accepted_at) ||
                    empty($this->applicant->submission_accepted_by)
                ) {
                    $applicant->submission_accepted_at = Carbon::now();
                    $applicant->submission_accepted_by = \Auth::user()->id;
                    //                $applicant_data['submission_accepted_at'] = now();
                    //                $applicant_data['submission_accepted_by'] = \Auth::id();
                }
            }


            if ($this->submission_status === 'rejected') {
                $applicant->removeRole('applicant');
                $applicant->assignRole('blocked applicant');

                $applicant->declined_at = Carbon::now();
                $applicant->declined_by = \Auth::user()->id;
//                $applicant_data['declined_at'] = now();
//                $applicant_data['declined_by'] = \Auth::id();
            }

            $applicant->save();
//            $this->applicant->update($applicant_data);

//            if ($this->submission_status === 'accepted'){
//                $applicant->removeRole('applicant');
//                $applicant->assignRole('accepted applicant');
//            }

//            if ($this->submission_status === 'rejected'){
//                $applicant->removeRole('applicant');
//                $applicant->assignRole('blocked applicant');
//            }

            if ($this->send_interview_email && !empty($this->submission_interview_at)) {
                Mail::to($this->applicant->email)
                    ->send(new ApplicantInterviewNotification($this->applicant, $this->feedback));
                return $this->flash(
                    'success',
                    'Submission saved and email sent.',
                    [
                        'position' => 'top-end',
                        'timer' => 2000,
                        'showConfirmButton' => false,
                        'confirmButtonColor' => '#10b981',
                    ],
                    route('dashboard')
                );
            }

            return $this->flash(
                'success',
                'Submission saved.',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#10b981',
                ],
                route('dashboard')
            );
        } catch (Exception $e) {
            Log::error('Error saving submission | ' . $e->getMessage());

            $this->alert('error', 'Unable to save', [
                'position'           => 'center',
                'timer'              => null,
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.cpr.assess-submission')
            ->layout('layouts.app');
    }
}
