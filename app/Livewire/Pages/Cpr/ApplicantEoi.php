<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\EOI;
use App\Models\Prices;
use App\Models\User;
use App\Models\Document;
//use Carbon\Carbon;
use Carbon\Carbon;
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
//use Livewire\Attributes\Validate;


class ApplicantEoi extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public int $eoi_id = 0;

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
    public $job_description;
    public $qualification_certificates;
    public $training_certificates;
    public $file_name;
    public $file_location;
    public $file_path;
    public $doc_type;

    public $existing_job_description;
    public $existing_qualification_certificates;
    public $existing_training_certificates;

    public function mount()
    {
        // Prevent access if Chartered Practitioners Portal is switched off
        if (!Config::get('cpp.active')) {
            Redirect::to('/cpr-coming-soon');
        }

        $this->user = Auth::user();

        $this->first_name   = $this->user->first_name;
        $this->last_name    = $this->user->last_name;
        $this->email        = $this->user->email;
        $this->phone_1      = $this->user->phone_1;
        $this->phone_2      = $this->user->phone_2;
        $this->phone_3      = $this->user->phone_3;

//        $this->eoi = EOI::where('user_id', $this->user->id)?->first();
//
//        if ($this->eoi) {
//            $this->current_role = $this->eoi->current_role;
//            $this->employment_history = $this->eoi->employment_history;
//            $this->qualifications = $this->eoi->qualifications;
//            $this->training = $this->eoi->training;
//        }

//        $this->existing_job_description = Document::where('user_id', $this->user->id)
//                                                  ->where('eoi_id', $this->eoi->id)
//                                                  ->where('doc_type', 'job_description')
//                                                  ->first();
//
//        $this->existing_qualification_certificates = Document::where('user_id', $this->user->id)
//                                                             ->where('eoi_id', $this->eoi->id)
//                                                             ->where('doc_type', 'qualification_certificate')
//                                                             ->get();
//
//        $this->existing_training_certificates = Document::where('user_id', $this->user->id)
//                                                        ->where('eoi_id', $this->eoi->id)
//                                                        ->where('doc_type', 'training_certificate')
//                                                        ->get();
    }

    public function downloadFile(Document $document)
    {
        $file_loc = 'public/submitted_documents/' . Auth::id() . '/' . $document->file_name;
        if (storage::disk('local')->exists($file_loc)) {
            return Storage::download($file_loc);
        }
//        if (storage::disk('local')->exists($document->file_location)) {
//            return Storage::download($document->file_location);
//        }
        $this->alert('error', 'Error', [
            'position' => 'center',
            'timer' => null,
            'text' => 'Unable to download file. It has probably been deleted.',
//            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonColor' => '#dc2626',
        ]);
    }

    public function deleteFile(Document $document)
    {
        if ($document->user_id !== Auth::user()->id) {
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

//        if (storage::disk('local')->exists($document->file_location)) {
//            Storage::delete($document->file_location);
//        }

        $document->delete();
        $this->save();
    }

    public function save($submit = false)
    {
        $this->validate([
            'first_name'                    => 'required|min:2',
            'last_name'                     => 'required|min:2',
            'email'                         => 'required|email',
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

            if (null !== $this->job_description) {
                $filename = 'Job_Description_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHis');
                $filename .= '.' . $this->job_description->getClientOriginalExtension();

//                $this->file_path = $this->job_description->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);

                $this->job_description->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);


                Document::updateOrCreate([
                    'user_id'       => $this->user->id,
                    'doc_type'      => 'job_description',
                    'eoi_id'        => $eoi->id,
                ], [
                    'user_id'       => $this->user->id,
                    'file_name'     => $filename,
//                    'file_location' => $this->file_path,
                    'doc_type'      => 'job_description',
                    'eoi_id'        => $eoi->id,
                ]);
            }

            if (null !== $this->qualification_certificates) {
                $count = 1;
                foreach ($this->qualification_certificates as $qualification_certificate) {
                    $filename = 'Qualification_Certificate_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHis') . '_' . $count ;
                    $filename .= '.' . $qualification_certificate->getClientOriginalExtension();

                    $qualification_certificate->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);
//                    $this->file_path = $qualification_certificate->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);

                    Document::create([
                        'user_id'       => $this->user->id,
                        'doc_type'      => 'qualification_certificate',
                        'eoi_id'        => $eoi->id,
                        'file_name'     => $filename,
//                        'file_location' => $this->file_path,
                    ]);
                    $count ++;
                }
            }

            if(null !== $this->training_certificates) {
                $count = 1;
                foreach ($this->training_certificates as $training_certificate) {
                    $filename = 'Training_Certificate_' . $this->user->first_name . '_' . $this->user->last_name . '_' . Carbon::parse(now())->format('YmdHis') . '_' . $count ;
                    $filename .= '.' . $training_certificate->getClientOriginalExtension();

                    $training_certificate->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);
//                    $this->file_path = $training_certificate->storeAs(path: 'public/submitted_documents/' . $this->user->id, name: $filename);


                    Document::create([
                        'user_id'       => $this->user->id,
                        'doc_type'      => 'training_certificate',
                        'eoi_id'        => $eoi->id,
                        'file_name'     => $filename,
//                        'file_location' => $this->file_path,
                    ]);
                    $count++;
                }
            }

//            $this->alert(
//                'info', 'Expression Of Interest Saved', [
//                'position' => 'top-end',
//                'timer' => 2000,
//                'showConfirmButton' => false,
//            ]);

            if(!$submit) {
                return $this->flash(
                    'info', 'Expression Of Interest Saved', [
                        'position'          => 'top-end',
                        'timer'             => 2000,
                        'showConfirmButton' => false,
                    ],
                    request()->header('Referer')
                );
            }

        } catch (\Exception $e) {
            $this->alert('error', $e->getMessage(), [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }



//        dump('save');
    }

    public function saveAndSubmit()
    {
        $this->save(true);
        dump('submit');
    }

    public function render()
    {
        $this->eoi = EOI::where('user_id', $this->user->id)?->first();

        if ($this->eoi) {
            $this->current_role = $this->eoi->current_role;
            $this->employment_history = $this->eoi->employment_history;
            $this->qualifications = $this->eoi->qualifications;
            $this->training = $this->eoi->training;

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

        return view('livewire.pages.cpr.applicant-eoi')
            ->layout('layouts.app');
    }
}
