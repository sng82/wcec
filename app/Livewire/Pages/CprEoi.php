<?php

namespace App\Livewire\Pages;

use App\Models\EOI;
use App\Models\Prices;
use App\Models\User;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Livewire\Attributes\Validate;

class CprEoi extends Component
{
    use UsesSpamProtection;
    use LivewireAlert;
    use WithFileUploads;

    public $title = "Chartered Practitioners - Expression of Interest";
    public $description = "Register your interest in joining the Chartered Practitioners Register";
    public $eoi_fee;

    public $first_name;
    public $last_name;
    public $email;
    public $phone_1;
    public $phone_2;
    public $phone_3;
    public $password;
    public $password_confirmation;
    public $current_role;
    public $job_description;
    public $qualification_certificates;
    public $training_certificates;
    public $employment_history;
    public $qualifications;
    public $training;


    public HoneypotData $extraFields;

    public function mount()
    {
        // Prevent access if Chartered Practitioners Portal is switched off
        if (!Config::get('cpp.active')) {
            Redirect::to('/cpr-coming-soon');
        }
        $this->extraFields = new HoneypotData();
    }

    public function submit()
    {
        if (Config::get('app.env') === 'production') {
            $this->protectAgainstSpam();
        }

//        dd('passed spam check');

        $validated_user = $this->validate([
            'first_name'                    => 'required|min:2',
            'last_name'                     => 'required|min:2',
            'email'                         => 'required|email',
            'phone_1'                       => 'required|min:9',
            'phone_2'                       => 'nullable|min:9',
            'phone_3'                       => 'nullable|min:9',
            'password'                      => ['required','confirmed', Password::defaults()],
        ]);

        $validated_application = $this->validate([
            'current_role'                  => 'required|min:9',
            'employment_history'            => 'required|min:9',
            'qualifications'                => 'required|min:9',
            'training'                      => 'required|min:9',
        ]);

        $validated_docs = $this->validate([
            'job_description'               => 'nullable|file|mimes:docx,doc,pdf',
            'qualification_certificates'    => 'nullable|file|mimes:docx,doc,pdf,png,jpg,jpeg,bmp',
            'training_certificates'         => 'nullable|file|mimes:docx,doc,pdf,png,jpg,jpeg,bmp',
        ]);

        try {
            $new_user = User::create([
                'first_name'            => trim($this->first_name),
                'last_name'             => trim($this->last_name),
                'email'                 => trim(Str::of($this->email)->lower()),
                'phone_1'               => trim($this->phone_1),
                'phone_2'               => trim($this->phone_2),
                'phone_3'               => trim($this->phone_3),
                'password'              => Str::random(12),
            ]);

            $new_user->assignRole('applicant');

            $new_application = EOI::create([
                'user_id'               => $new_user->id,
                'current_role'          => $this->current_role,
                'employment_history'    => $this->employment_history,
                'qualifications'        => $this->qualifications,
                'training'              => $this->training,
            ]);


            // @todo: store docs: job_description | qualification_certificates | training_certificates

            $this->alert('info', 'User added successfully', [
                'position' => 'top-end',
                'timer' => 2000,
                'toast' => true,
                'showConfirmButton' => false,
                'confirmButtonColor' => '#06b6d4',
            ]);

//            return $this->flash(
//                'info', 'User added successfully', [
//                'position' => 'top-end',
//                'timer' => 2000,
//                'showConfirmButton' => false,
//            ], 'cpr/members'
//            );

        } catch (\Exception $e) {
            $this->alert('error', 'Unable to create. ' . $e->getMessage(), [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
        }


    }

    public function render()
    {
        $this->eoi_fee = Prices::where('price_type', 'eoi')
                               ->where('start_date', '<=', now())
                               ->where(function($query) {
                                   $query->where('end_date', '>', now())
                                         ->orWhere('end_date', null);
                               })
                               ->first();
        return view('livewire.pages.cpr-eoi')->layout('layouts.front');
    }
}
