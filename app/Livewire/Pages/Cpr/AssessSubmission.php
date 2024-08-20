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

class AssessSubmission extends Component
{
    use LivewireAlert;

    public $applicant;
    public $submission_document;
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
            $this->submission_document      = Document::where('user_id', $id)
                                                      ->where('doc_type', 'submission')
                                                      ->orderBy('id', 'DESC')
                                                      ->first();
            $this->path                     = $this->applicant->registration_pathway;
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
        $file_loc = 'private/submitted_documents/'
                    . $this->submission_document->user_id . '/'
                    . $this->submission_document->file_name;
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

    public function save()
    {
        try{
            $this->submission = Submission::updateOrCreate([
                'user_id' => $this->applicant->id,
            ], [
                'user_id'   => $this->applicant->id,
                'feedback'  => $this->feedback,
                'notes'     => $this->notes,
            ]);

            $applicant_data = [];
            $applicant_data['submission_status']        = $this->submission_status;
            $applicant_data['submission_interview_at']  = $this->submission_interview_at !== ''
                                                                ? $this->submission_interview_at
                                                                : null;

            if (
                $this->submission_status === 'accepted' && (
                    empty($this->applicant->submission_accepted_at) ||
                    empty($this->applicant->submission_accepted_by)
                )
            ) {
                $applicant_data['submission_accepted_at'] = now();
                $applicant_data['submission_accepted_by'] = \Auth::id();
            }

            if ($this->submission_status === 'rejected') {
                $applicant_data['declined_at'] = now();
                $applicant_data['declined_by'] = \Auth::id();
            }

            $this->applicant->update($applicant_data);

            if ($this->submission_status === 'accepted'){
                $this->applicant->removeRole('applicant');
                $this->applicant->assignRole('accepted applicant');
            }

            if ($this->submission_status === 'rejected'){
                $this->applicant->removeRole('applicant');
                $this->applicant->assignRole('blocked applicant');
            }

            if ($this->send_interview_email && !empty($this->submission_interview_at)) {
                Mail::to($this->applicant->email)
                    ->send(new ApplicantInterviewNotification($this->applicant));
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
