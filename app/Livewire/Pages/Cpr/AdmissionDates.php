<?php

namespace App\Livewire\Pages\Cpr;

use App\Models\SubmissionDate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AdmissionDates extends Component
{


    use LivewireAlert;

    //    #[Validate('required')]
    //    #[Validate('date', message:'Invalid date format')]
    //    #[Validate('unique:admission_dates,admission_date', message:'This date already exists.')]
    public $admission_date;
    public $submission_deadline;
    public $upcoming_dates;
    //    public $title = "CPR Dashboard";

    public function rules() {
        return [
            'admission_date' => [
                'required',
                'date',
                'after_or_equal:submission_deadline',
                Rule::unique('submission_dates', 'admission_date')
                    ->withoutTrashed(),
            ],
            'submission_deadline' => [
                'required',
                'date',
                'after:today',
            ]
        ];
    }

    public function mount()
    {
        $this->upcoming_dates = SubmissionDate::with('updatedBy')
                                              ->where('admission_date', '>', now())
                                              ->orderBy('admission_date')
                                              ->get();
    }

    public function create()
    {
        $this->validate();

        try {
            SubmissionDate::create([
                'admission_date'        => $this->admission_date,
                'submission_deadline'   => $this->submission_deadline,
                'updated_by'            => Auth::user()->id,
            ]);

            return $this->flash(
                'success',
                'Admission Date Added.',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#10b981',
                ],
                route('admission-dates')
            );
        } catch (\Exception $e) {
            $this->alert(
                'error',
                'Unable to Create - ' . $e->getMessage(),
                [
                    'position' => 'center',
                    'timer' => null,
                    'showConfirmButton' => true,
                    'confirmButtonColor' => '#dc2626',
                ]
            );
        }
    }

    public function delete($dateId)
    {
        try{
            SubmissionDate::findOrFail($dateId)?->update([
                'deleted_by' => Auth::user()->id,
                'deleted_at' => now(),
            ]);
            return $this->flash(
                'info',
                'Admission Date Deleted.',
                [
                    'position' => 'top-end',
                    'timer' => 2000,
                    'showConfirmButton' => false,
                    'confirmButtonColor' => '#06b6d4',
                ],
                route('admission-dates')
            );
        } catch(\Exception $e) {
            $this->alert('error', 'Unable to delete - somebody may have beaten you to it!', [
                'position' => 'center',
                'timer' => null,
                'showConfirmButton' => true,
                'confirmButtonColor' => '#dc2626',
            ]);
            //            session()->flash('error', 'Failed to find and delete item - somebody may have beaten you to it!');
        }
    }

    public function messages() {
        return [
            'admission_date.required' => 'An Admission Date is required',
            'admission_date.date' => 'Invalid Admission Date',
            'admission_date.unique' => 'This Admission Date is already set',
            'admission_date.after' => 'Submission Deadline must be BEFORE Admission Date',
            'submission_deadline.required' => 'A Submission Deadline is required',
            'submission_deadline.date' => 'Invalid Submission Deadline',
            'submission_deadline.after' => 'Submission Deadline cannot be a date in the past',
        ];
    }

    public function render()
    {
//        return view('livewire.pages.cpr.admission-dates')
//            ->layout('layouts.app', [
////                'title' => $this->title,
//            ]);

//        return view('livewire.pages.cpr.admission-dates')
//            ->layout('layouts.app', [
//                'upcoming_dates' => SubmissionDate::with('updatedBy')
//                                              ->where('admission_date', '>', now())
//                                              ->orderBy('admission_date')
//                                              ->get(),
//            ]);

        return view('livewire.pages.cpr.admission-dates')
            ->layout('layouts.app');
    }
}
