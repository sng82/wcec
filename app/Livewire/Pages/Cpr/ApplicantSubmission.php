<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Document;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Log;

class ApplicantSubmission extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $registration_path;
    public $submission_paper;
    public $proof_of_qualifications;
    public $user;

    public function mount()
    {
        // Prevent access if Chartered Practitioners Portal is switched off
        if (!Config::get('cpp.active')) {
            Redirect::to('/cpr-coming-soon');
        }

        $this->user = Auth::user();

    }

    // Form submit
    public function submit()
    {
        $this->validate([
            'registration_path'         => ['required'],
            'submission_paper'          => ['required_if:registration_path,individual'],
            'proof_of_qualifications'   => ['required_if:registration_path,standard'],
            'proof_of_qualifications.*' => [
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:5120'
            ],
        ]);

//        dd('validation passed');

        try {
            if (null !== $this->submission_paper) {
                $filename = 'Submission_'
                            . str_replace(' ', '_', $this->user->first_name) . '_'
                            . str_replace(' ', '_', $this->user->last_name) . '_'
                            . Carbon::parse(now())->format('YmdHisu')
                            . '.' . $this->submission_paper->getClientOriginalExtension();

                $this->submission_paper->storeAs(
                    path: 'private/submitted_documents/' . $this->user->id,
                    name: $filename
                );

                Document::create([
                    'file_name' => $filename,
                    'doc_type'  => 'submission',
                    'user_id'   => $this->user->id,
                ]);
            }

            if (null !== $this->proof_of_qualifications) {
                foreach ($this->proof_of_qualifications as $proof) {
                    $filename = 'Qualification_Proof_'
                                . str_replace(' ', '_', $this->user->first_name) . '_'
                                . str_replace(' ', '_', $this->user->last_name) . '_'
                                . Carbon::parse(now())->format('YmdHisu')
                                . '.' . $proof->getClientOriginalExtension();

                    $proof->storeAs(
                        path: 'private/submitted_documents/' . $this->user->id,
                        name: $filename
                    );

                    Document::create([
                        'user_id'   => $this->user->id,
                        'doc_type'  => 'qualification_proof',
                        'file_name' => $filename,
                    ]);
                }
            }

            User::find($this->user->id)?->update([
                'submission_status'    => 'submitted',
                'registration_pathway' => $this->registration_path,
            ]);

            return $this->flash(
                'success',
                'Registration Submitted.',
                [
                    'text'               => 'We\'ll be in touch soon.',
                    'position'           => 'center',
                    'timer'              => null,
                    'showConfirmButton'  => true,
                    'confirmButtonColor' => '#10b981',
                    'width'              => '500'
                ],
                route('dashboard')
            );
        } catch (Exception $e) {
            Log::error('Unable to submit submission | ' . $e->getMessage());

            $this->alert('error', 'Unable to submit', [
                'position'           => 'center',
                'timer'              => null,
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.pages.cpr.applicant-submission')
            ->layout('layouts.app');
    }
}
