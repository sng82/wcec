<?php

namespace App\Livewire\Pages\Cpr;

use App\Mail\ExpressionSubmittedNotification;
use App\Models\EOI;
use App\Models\User;
use App\Models\Document;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use ZipArchive;

//use Livewire\Attributes\Validate;


class ApplicantEoi extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public int $eoi_id = 0;
    public $eoi;
    public $user;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_main;
    public $phone_mobile;
    public $current_role;
    public $employment_history;
    public $qualifications;
    public $training;
    public $cv;
    public $existing_cv;
    public $job_description;
    public $existing_job_description;
    public $qualification_certificates;
    public $existing_qualification_certificates;
    public $training_certificates;
    public $existing_training_certificates;


    public function messages()
    {
        return [
            'phone_main.phone' => 'The Phone (Main) field contains an invalid number',
            'phone_mobile.phone' => 'The Phone (Mobile) field contains an invalid number',
        ];
    }

    public function mount()
    {
        // Prevent access if Chartered Practitioners Portal is switched off
        if (!Config::get('cpp.active')) {
            Redirect::to('/cpr-coming-soon');
        }

        $this->user = Auth::user();

        // Prevent access if user has already submitted their EoI.
        if ($this->user->eoi_status === 'submitted' || $this->user->eoi_status === 'accepted') {
            return $this->flash(
                'error',
                'This Expression of Interest has already been submitted.',
                [
                    'position'           => 'center',
                    'timer'              => null,
                    'showConfirmButton'  => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                'cpr/dashboard'
            );
        }

        $this->first_name = $this->user->first_name;
        $this->last_name  = $this->user->last_name;
        $this->email      = $this->user->email;
        $this->phone_main    = $this->user->phone_main;
        $this->phone_mobile    = $this->user->phone_mobile;

        $this->eoi = EOI::where('user_id', $this->user->id)?->latest()->first();

        if ($this->eoi) {
            $this->eoi_id             = $this->eoi->id;
            $this->current_role       = $this->eoi->current_role;
            $this->employment_history = $this->eoi->employment_history;
            $this->qualifications     = $this->eoi->qualifications;
            $this->training           = $this->eoi->training;

            $this->existing_cv = Document::where('user_id', $this->user->id)
                                         ->where('eoi_id', $this->eoi->id)
                                         ->where('doc_type', 'cv')
                                         ->first();

            $this->existing_job_description = Document::where('user_id', $this->user->id)
                                                      ->where('eoi_id', $this->eoi->id)
                                                      ->where('doc_type', 'job_description')
                                                      ->first();

            $this->existing_qualification_certificates = Document::where('user_id', $this->user->id)
                                                                 ->where('eoi_id', $this->eoi->id)
                                                                 ->where('doc_type', 'qualification_certificate')
                                                                 ->get();

            $this->existing_training_certificates = Document::where('user_id', $this->user->id)
                                                            ->where('eoi_id', $this->eoi->id)
                                                            ->where('doc_type', 'training_certificate')
                                                            ->get();
        }
    }

    public function downloadFile(Document $document)
    {
        $file_loc = 'private/submitted_documents/' . Auth::id() . '/' . $document->file_name;
//        $file_loc = 'public/submitted_documents/' . Auth::id() . '/' . $document->file_name;
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

    public function downloadFiles($doc_type)
    {
        $zip         = new ZipArchive;
        $zipFileName = str_replace(' ', '_', $this->user->first_name) . '_'
                       . str_replace(' ', '_', $this->user->last_name) . '_'
                       . str($doc_type)->title() . 's_'
                       . Carbon::parse(now())->format('YmdHisu')
                       . '.zip';

        if ($zip->open(storage_path($zipFileName), ZipArchive::CREATE) === true) {
            $documents = Document::where('user_id', Auth::user()->id)
                                 ->where('eoi_id', $this->eoi_id)
                                 ->where('doc_type', $doc_type)
                                 ->get();

            foreach ($documents as $document) {
                $zip->addFile(
//                    storage_path('app/public/submitted_documents/' . Auth::id() . '/' . $document->file_name),
                    storage_path(
                        'app/private/submitted_documents/'
                        . Auth::id() . '/'
                        . $document->file_name
                    ),
                    $document->file_name
                );
            }

            $zip->close();

            return response()->download(storage_path($zipFileName))->deleteFileAfterSend();
        }

        $this->alert('error', 'Unable to download files', [
            'position'           => 'center',
            'timer'              => null,
            'showConfirmButton'  => true,
            'confirmButtonColor' => '#dc2626',
        ]);
    }

    public function deleteFile(Document $document)
    {
        if ($document->user_id !== Auth::id()) {
            $this->alert('error', 'You do not have permission to delete this file', [
                'position'           => 'center',
                'timer'              => null,
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#dc2626',
            ]);

            return null;
        }

//        $file_loc = 'public/submitted_documents/' . Auth::id() . '/' . $document->file_name;
        $file_loc = 'private/submitted_documents/' . Auth::id() . '/' . $document->file_name;


        if (storage::disk('local')->exists($file_loc)) {
            Storage::delete($file_loc);
        }

        $document->delete();
        $this->saveProgress(false);
    }

    public function deleteFiles($doc_type)
    {
        $documents = Document::where('user_id', Auth::user()->id)
                             ->where('eoi_id', $this->eoi_id)
                             ->where('doc_type', $doc_type)
                             ->get();

        foreach ($documents as $document) {
            $file_loc = 'private/submitted_documents/' . Auth::id() . '/' . $document->file_name;
//            $file_loc = 'public/submitted_documents/' . Auth::id() . '/' . $document->file_name;

            if (storage::disk('local')->exists($file_loc)) {
                Storage::delete($file_loc);
            }

            $document->delete();
        }

        $this->saveProgress(false);
    }

    public function saveProgress($skip_feedback = false)
    {
        $this->validate([
            'first_name'                    => 'required|min:2',
            'last_name'                     => 'required|min:2',
            'email'                         => 'required|email',
            'phone_main'                    => 'required|phone:GB',
            'phone_mobile'                  => 'nullable|phone:GB,mobile',
            'cv'                            => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'job_description'               => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'qualification_certificates.*'  => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'training_certificates.*'       => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);

        try {
            User::findOrFail($this->user->id)?->update([
                'first_name'    => $this->first_name,
                'last_name'     => $this->last_name,
                'email'         => $this->email,
                'phone_main'    => $this->phone_main,
                'phone_mobile'  => $this->phone_mobile,
            ]);

            $this->eoi = EOI::updateOrCreate([
                'user_id' => $this->user->id,
            ], [
                'user_id'            => $this->user->id,
                'current_role'       => $this->current_role,
                'employment_history' => $this->employment_history,
                'qualifications'     => $this->qualifications,
                'training'           => $this->training,
            ]);

            if (null !== $this->cv) {
                $filename = 'CV_'
                            . str_replace(' ', '_', $this->user->first_name) . '_'
                            . str_replace(' ', '_', $this->user->last_name) . '_'
                            . Carbon::parse(now())->format('YmdHisu')
                            . '.' . $this->cv->getClientOriginalExtension();

//                $this->cv->storeAs(
//                    path: 'public/submitted_documents/' . $this->user->id,
//                    name: $filename
//                );

                $this->cv->storeAs(
                    path: 'private/submitted_documents/' . $this->user->id,
                    name: $filename
                );

                Document::updateOrCreate([
                    'user_id'  => $this->user->id,
                    'doc_type' => 'cv',
                    'eoi_id'   => $this->eoi->id,
                ], [
                    'user_id'   => $this->user->id,
                    'file_name' => $filename,
                    'doc_type'  => 'cv',
                    'eoi_id'    => $this->eoi->id,
                ]);
            }

            if (null !== $this->job_description) {
                $filename = 'Job_Description_'
                            . str_replace(' ', '_', $this->user->first_name) . '_'
                            . str_replace(' ', '_', $this->user->last_name) . '_'
                            . Carbon::parse(now())->format('YmdHisu')
                            . '.' . $this->job_description->getClientOriginalExtension();

                $this->job_description->storeAs(
//                    path: 'public/submitted_documents/' . $this->user->id,
                    path: 'private/submitted_documents/' . $this->user->id,
                    name: $filename
                );

                Document::updateOrCreate([
                    'user_id'  => $this->user->id,
                    'doc_type' => 'job_description',
                    'eoi_id'   => $this->eoi->id,
                ], [
                    'user_id'   => $this->user->id,
                    'file_name' => $filename,
                    'doc_type'  => 'job_description',
                    'eoi_id'    => $this->eoi->id,
                ]);
            }

            if (null !== $this->qualification_certificates) {
                foreach ($this->qualification_certificates as $qualification_certificate) {
                    $filename = 'Qualification_Certificate_'
                                . str_replace(' ', '_', $this->user->first_name) . '_'
                                . str_replace(' ', '_', $this->user->last_name) . '_'
                                . Carbon::parse(now())->format('YmdHisu')
                                . '.' . $qualification_certificate->getClientOriginalExtension();

                    $qualification_certificate->storeAs(
                        path: 'private/submitted_documents/' . $this->user->id,
//                        path: 'public/submitted_documents/' . $this->user->id,
                        name: $filename
                    );

                    Document::create([
                        'user_id'   => $this->user->id,
                        'doc_type'  => 'qualification_certificate',
                        'eoi_id'    => $this->eoi->id,
                        'file_name' => $filename,
                    ]);
                }
            }

            if (null !== $this->training_certificates) {
                foreach ($this->training_certificates as $training_certificate) {
                    $filename = 'Training_Certificate_'
                                . str_replace(' ', '_', $this->user->first_name) . '_'
                                . str_replace(' ', '_', $this->user->last_name) . '_'
                                . Carbon::parse(now())->format('YmdHisu')
                                .'.' . $training_certificate->getClientOriginalExtension();

                    $training_certificate->storeAs(
//                        path: 'public/submitted_documents/' . $this->user->id,
                        path: 'private/submitted_documents/' . $this->user->id,
                        name: $filename
                    );

                    Document::create([
                        'user_id'   => $this->user->id,
                        'doc_type'  => 'training_certificate',
                        'eoi_id'    => $this->eoi->id,
                        'file_name' => $filename,
                    ]);
                }
            }

            if ($skip_feedback !== true) {
                return $this->flash(
                    'info', 'Expression Of Interest Saved', [
                    'position'          => 'top-end',
                    'timer'             => 2000,
                    'showConfirmButton' => false,
                ],
                    '/cpr/dashboard'
//                    request()?->header('Referer')
                );
            }
        } catch (Exception $e) {
            $this->alert('error', $e->getMessage(), [
                'position'           => 'center',
                'timer'              => null,
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }

    public function submitEoI()
    {
        $this->saveProgress(true);

        // Gather all files requiring validation into these arrays so that they
        // can all be validated together and any/all errors can be displayed at
        // the same time.
        $to_be_validated = [];
        $validation_messages = [];

        $cv_doc = null;
        $job_desc_doc = null;
        if ($this->eoi) {
            // The EoI may have been worked on and saved prior to this submission,
            // so there may be documents that have been previously saved.
            $cv_doc = Document::where('eoi_id', $this->eoi->id)->where('doc_type', 'cv')->first();
            $job_desc_doc = Document::where('eoi_id', $this->eoi->id)->where('doc_type', 'job_description')->first();
        }

        if (!$cv_doc) {
            $to_be_validated['cv'] = 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120';
        }

        if (!$job_desc_doc) {
            $to_be_validated['current_role'] = 'required_without:job_description';
            $validation_messages['current_role.required_without'] = 'Either a Job Description document OR a description of your current role is required.';
        }

        $to_be_validated['qualification_certificates.*']    = 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120';
        $to_be_validated['training_certificates.*']         = 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120';
        $to_be_validated['employment_history']              = 'required|min:3';
        $to_be_validated['qualifications']                  = 'required|min:3';
        $to_be_validated['training']                        = 'required|min:3';

        $validation_messages['qualifications.required'] = 'Please provide details of qualifications. Type \'N/A\' if you have nothing to add here.';
        $validation_messages['training']                = 'Please provide details of training undertaken. Type \'N/A\' if you have nothing to add here.';

        $this->validate($to_be_validated, $validation_messages);


//        $this->saveProgress(true);

        $this->eoi->update(['submitted_at' => now()]);
        $this->user->update(['eoi_status' => 'submitted']);

        Mail::to(config('mail.membership_enquiry_mail_recipient'))
            ->send(new ExpressionSubmittedNotification($this->user));

        $extended_message = $this->user->registration_fee_paid
            ? 'We\'ll be in touch soon.'
            : 'Please pay your registration fee to progress your application.';

        return $this->flash(
            'success',
            'Expression Of Interest Submitted.',
            [
                'text'               => $extended_message,
                'position'           => 'center',
                'timer'              => null,
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#10b981',
                'width'              => '500'
            ],
            route('dashboard')
        );
    }

    public function render()
    {
//        $this->eoi = EOI::where('user_id', $this->user->id)?->first();
//
//        if ($this->eoi) {
//            $this->eoi_id = $this->eoi->id;
//            $this->current_role = $this->eoi->current_role;
//            $this->employment_history = $this->eoi->employment_history;
//            $this->qualifications = $this->eoi->qualifications;
//            $this->training = $this->eoi->training;
//
//            $this->existing_cv = Document::where('user_id', $this->user->id)
//                                         ->where('eoi_id', $this->eoi->id)
//                                         ->where('doc_type', 'cv')
//                                         ->first();
//
//            $this->existing_job_description = Document::where('user_id', $this->user->id)
//                                                      ->where('eoi_id', $this->eoi->id)
//                                                      ->where('doc_type', 'job_description')
//                                                      ->first();
//
//            $this->existing_qualification_certificates = Document::where('user_id', $this->user->id)
//                                                                 ->where('eoi_id', $this->eoi->id)
//                                                                 ->where('doc_type', 'qualification_certificate')
//                                                                 ->get();
//
//            $this->existing_training_certificates = Document::where('user_id', $this->user->id)
//                                                            ->where('eoi_id', $this->eoi->id)
//                                                            ->where('doc_type', 'training_certificate')
//                                                            ->get();
//        }

        return view('livewire.pages.cpr.applicant-eoi')
            ->layout('layouts.app');
    }
}
