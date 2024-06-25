<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\EOI;
//use App\Models\Prices;
use App\Models\User;
use App\Models\Document;
//use Carbon\Carbon;
use Carbon\Carbon;
//use Illuminate\Routing\Route;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Str;
//use Illuminate\Validation\Rule;
//use Illuminate\Validation\Rules\Password;
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
    public $phone_1;
    public $phone_2;
    public $phone_3;
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
//    public $file_name;
//    public $file_location;
//    public $file_path;
//    public $doc_type;

    public function mount()
    {
        // Prevent access if Chartered Practitioners Portal is switched off
        if (!Config::get('cpp.active')) {
            Redirect::to('/cpr-coming-soon');
        }

        $this->user = Auth::user();

        // Prevent access if user has already submitted their EoI.
        if($this->user->eoi_status === 'submitted' || $this->user->eoi_status === 'accepted') {
            return $this->flash('error', 'This Expression of Interest has already been submitted.',
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ],
                'cpr/dashboard');
        }

        $this->first_name   = $this->user->first_name;
        $this->last_name    = $this->user->last_name;
        $this->email        = $this->user->email;
        $this->phone_1      = $this->user->phone_1;
        $this->phone_2      = $this->user->phone_2;
        $this->phone_3      = $this->user->phone_3;

        $this->eoi = EOI::where('user_id', $this->user->id)?->first();

        if ($this->eoi) {
            $this->eoi_id = $this->eoi->id;
            $this->current_role = $this->eoi->current_role;
            $this->employment_history = $this->eoi->employment_history;
            $this->qualifications = $this->eoi->qualifications;
            $this->training = $this->eoi->training;

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
        $file_loc = 'public/submitted_documents/' . Auth::id() . '/' . $document->file_name;
        if (storage::disk('local')->exists($file_loc)) {
            return Storage::download($file_loc);
        }
        $this->alert('error', 'Error', [
            'position' => 'center',
            'timer' => null,
            'text' => 'Unable to download file. It has probably been deleted.',
            'showConfirmButton' => true,
            'confirmButtonColor' => '#dc2626',
        ]);
    }

    public function downloadFiles($doc_type)
    {
        $zip = new ZipArchive;
        $zipFileName = $this->user->first_name . '_' . $this->user->last_name . '_' . str($doc_type)->title() . 's_' . Carbon::parse(now())->format('YmdHisu') . '.zip';

        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            $documents = Document::where('user_id', Auth::user()->id)
                                 ->where('eoi_id', $this->eoi_id)
                                 ->where('doc_type', $doc_type)
                                 ->get();

            foreach ($documents as $document) {
                $zip->addFile(
                    storage_path('app/public/submitted_documents/' . Auth::id() . '/' . $document->file_name),
                    $document->file_name
                );
            }

            $zip->close();
            return response()->download(public_path($zipFileName))->deleteFileAfterSend();
        }

        $this->alert('error', 'Unable to download files', [
            'position' => 'center',
            'timer' => null,
            'showConfirmButton' => true,
            'confirmButtonColor' => '#dc2626',
        ]);
    }

    public function deleteFile(Document $document)
    {
        if ($document->user_id !== Auth::id()) {
            $this->alert('error', 'You do not have permission to delete this file', [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
            return null;
        }

        $file_loc = 'public/submitted_documents/' . Auth::id() . '/' . $document->file_name;

        if (storage::disk('local')->exists($file_loc)) {
            Storage::delete($file_loc);
        }

        $document->delete();
        $this->save();
    }

    public function deleteFiles($doc_type)
    {
        $documents = Document::where('user_id', Auth::user()->id)
                             ->where('eoi_id', $this->eoi_id)
                             ->where('doc_type', $doc_type)
                             ->get();

        foreach ($documents as $document) {
            $file_loc = 'public/submitted_documents/' . Auth::id() . '/' . $document->file_name;

            if (storage::disk('local')->exists($file_loc)) {
                Storage::delete($file_loc);
            }

            $document->delete();
        }

        $this->save();
    }

    public function save($submit = false)
    {

        $this->validate([
            'first_name'                    => 'required|min:2',
            'last_name'                     => 'required|min:2',
            'email'                         => 'required|email',
            'cv'                            => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'job_description'               => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'qualification_certificates.*'  => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'training_certificates.*'       => 'nullable|file|mimes:pdf,doc,docx|max:2048',
//            'training_certificates'         => 'nullable|file|mimes:pdf,doc,docx|max:2048',
//            'qualification_certificates'    => 'nullable|file|mimes:pdf,doc,docx|max:2048',
//            'phone_3'                       => 'nullable|numeric',
//            'phone_2'                       => 'nullable|numeric',
//            'phone_1'                       => 'required|numeric',
        ]);

        try {
            User::findOrFail($this->user->id)?->update([
                'first_name' => $this->first_name,
                'last_name'  => $this->last_name,
                'email'      => $this->email,
                'phone_1'    => $this->phone_1,
                'phone_2'    => $this->phone_2,
                'phone_3'    => $this->phone_3,
            ]);

            $eoi = EOI::updateOrCreate([
                'user_id' => $this->user->id,
            ], [
                'user_id'               => $this->user->id,
                'current_role'          => $this->current_role,
                'employment_history'    => $this->employment_history,
                'qualifications'        => $this->qualifications,
                'training'              => $this->training,
            ]);

            if (null !== $this->cv) {
                $filename = 'CV_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHisu');
                $filename .= '.' . $this->cv->getClientOriginalExtension();

                $this->cv->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);

                Document::updateOrCreate([
                    'user_id'       => $this->user->id,
                    'doc_type'      => 'cv',
                    'eoi_id'        => $eoi->id,
                ], [
                    'user_id'       => $this->user->id,
                    'file_name'     => $filename,
                    'doc_type'      => 'cv',
                    'eoi_id'        => $eoi->id,
                ]);
            }

            if (null !== $this->job_description) {
                $filename = 'Job_Description_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHisu');
                $filename .= '.' . $this->job_description->getClientOriginalExtension();

                $this->job_description->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);

                Document::updateOrCreate([
                    'user_id'       => $this->user->id,
                    'doc_type'      => 'job_description',
                    'eoi_id'        => $eoi->id,
                ], [
                    'user_id'       => $this->user->id,
                    'file_name'     => $filename,
                    'doc_type'      => 'job_description',
                    'eoi_id'        => $eoi->id,
                ]);
            }

            if (null !== $this->qualification_certificates) {
                foreach ($this->qualification_certificates as $qualification_certificate) {
                    $filename = 'Qualification_Certificate_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHisu');
                    $filename .= '.' . $qualification_certificate->getClientOriginalExtension();

                    $qualification_certificate->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);

                    Document::create([
                        'user_id'       => $this->user->id,
                        'doc_type'      => 'qualification_certificate',
                        'eoi_id'        => $eoi->id,
                        'file_name'     => $filename,
                    ]);
                }
            }

            if (null !== $this->training_certificates) {
                foreach ($this->training_certificates as $training_certificate) {
                    $filename = 'Training_Certificate_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHisu');
                    $filename .= '.' . $training_certificate->getClientOriginalExtension();

                    $training_certificate->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);

                    Document::create([
                        'user_id'       => $this->user->id,
                        'doc_type'      => 'training_certificate',
                        'eoi_id'        => $eoi->id,
                        'file_name'     => $filename,
                    ]);
                }
            }

            if (!$submit) {
                return $this->flash(
                    'info', 'Expression Of Interest Saved', [
                        'position'          => 'top-end',
                        'timer'             => 2000,
                        'showConfirmButton' => false,
                    ],
                    request()?->header('Referer')
                );
            }
        } catch (Exception $e) {
            $this->alert('error', $e->getMessage(), [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }

    public function saveAndSubmit()
    {
        $this->save(true);

        if ($this->eoi) {
            // The EoI has been worked on and saved prior to this submission,
            // so there may be documents that have already been saved.
            $cv_doc = Document::where('eoi_id', $this->eoi->id)->where('doc_type', 'cv')->first();
            if (!$cv_doc) {
                $this->validate([
                    'cv' => 'required|file|mimes:pdf,doc,docx|max:2048'
                ]);
            }

            $job_desc_doc = Document::where('eoi_id', $this->eoi->id)->where('doc_type', 'job_description')->first();
            if (!$job_desc_doc) {
                $this->validate([
                    'current_role' => 'required_without:job_description',
                ] , [
                    'current_role.required_without' => 'Either a Job Description document OR a description of your current role is required.',
                ]);
            }

        }

        $this->validate([
//            'cv'                            => 'sometimes|required|file|mimes:pdf,doc,docx|max:2048',
//            'current_role'                  => 'required_without_all:job_description,existing_job_description',
            'qualification_certificates.*'  => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'training_certificates.*'       => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'employment_history'            => 'required|min:3',
            'qualifications'                => 'required|min:3',
            'training'                      => 'required|min:3',
        ], [
//            'current_role.required_without_all' => 'Either a Job Description document OR a description of your current role is required.',
            'qualifications.required'           => 'Please provide details of qualifications. Type \'N/A\' if you have nothing to add here.',
            'training'                          => 'Please provide details of training undertaken. Type \'N/A\' if you have nothing to add here.',
        ]);

        $this->user->update(['eoi_status' => 'submitted']);

        $extended_message = 'Please pay your registration fee to progress your application.';
        if ($this->user->registration_fee_paid) {
            $extended_message = 'We\'ll be in touch soon';
        }

        return $this->flash(
            'info', 'Expression Of Interest Submitted. ' . $extended_message , [
            'position'          => 'top-end',
            'timer'             => 8000,
            'showConfirmButton' => true,
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
