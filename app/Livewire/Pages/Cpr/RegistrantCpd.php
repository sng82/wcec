<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\Document;
use App\Models\PublicDocument;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Log;
use Mockery\Exception;

class RegistrantCpd extends Component
{
    use LivewireAlert;
    use WithPagination;
    use WithFileUploads;

    public $user;
    public $cpd_year_due;
    public $cpd_template_document;
    public $completed_cpd_document;
    public $renewal_window = 3; //how long, in months, before their registration expires that a user can renew.

    public function mount()
    {
        // Prevent access if Chartered Practitioners Portal is switched off
        if (!Config::get('cpp.active')) {
            Redirect::to('/cpr-coming-soon');
        }

        $this->user = Auth::user();
        $this->cpd_year_due = Carbon::parse($this->user->cpd_last_submitted_at)->addYear()->format('Y');
        $this->cpd_template_document = PublicDocument::where('doc_type', 'CPD Form')->first();
    }

    public function submit()
    {
//        $this->updateRegistrationExpiryDate();

//        $temp = Auth::user()?->registrationCanBeRenewed();
//
//        dd($temp);
//
//        $this->validate([
//            'completed_cpd_document' => 'required|file|mimes:xls,xlsx|max:5120',
//        ]);

        try {
            $filename = 'CPD_'
                        . $this->cpd_year_due . '_'
                        . str_replace(' ', '_', $this->user->first_name) . '_'
                        . str_replace(' ', '_', $this->user->last_name) . '.'
                        . $this->completed_cpd_document->getClientOriginalExtension();

            $this->completed_cpd_document->storeAs(
                path: 'private/submitted_documents/' . $this->user->id . '/cpd',
                name: $filename
            );

            Document::create([
               'user_id'    => $this->user->id,
               'doc_type'   => 'cpd',
               'file_name'  => $filename,
            ]);

            $this->user->update([
                'cpd_last_submitted_at' => Carbon::now(),
            ]);

//            $this->updateRegistrationExpiryDate();

            return $this->flash(
                'success',
                'CPD successfully submitted',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                ],
                route('dashboard')
            );

        } catch (Exception $e) {
            Log::error($e->getMessage());

            $this->alert('error', 'Error uploading CPD', [
                'position'           => 'center',
                'timer'              => null,
                'showConfirmButton'  => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }
    }

//    private function updateRegistrationExpiryDate(): void
//    {
//        $user = Auth::user();
//
//        if($user) {
//            $oldest_valid_date = Carbon::now()->subMonths($this->renewal_window);
//
//            if (
//                Carbon::parse($user->renewal_fee_last_paid_at) >= Carbon::parse($oldest_valid_date)
//                &&
//                Carbon::parse($user->cpd_last_submitted_at) >= Carbon::parse($oldest_valid_date)
//                &&
//                Carbon::parse($user->registration_expires_at) < Carbon::parse(now())->addYear()
//            ) {
//                $new_expires_at = Carbon::parse($this->user->registration_expires_at)->addYear();
//                $user->update([
//                    'registration_expires_at' => $new_expires_at
//                ]);
//            }
//        }
//    }

    public function render()
    {
        return view('livewire.pages.cpr.registrant-cpd')
            ->layout('layouts.app');
    }
}
