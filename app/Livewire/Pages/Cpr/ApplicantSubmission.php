<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Document;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Log;

class ApplicantSubmission extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $path;
    public $submission_paper;
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
            'path'              => 'required',
            'submission_paper'  => 'required_if:path,individual'
        ]);

        try {
            if (null !== $this->submission_paper) {
                $filename = 'Submission_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHisu');
                $filename .= '.' . $this->submission_paper->getClientOriginalExtension();

                $this->submission_paper->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);

                Document::create([
                    'file_name' => $filename,
                    'doc_type'  => 'submission',
                    'user_id'   => $this->user->id,
                ]);

                User::find($this->user->id)?->update([
                    'submission_status'    => 'submitted',
                    'registration_pathway' => $this->path,
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
            }
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
