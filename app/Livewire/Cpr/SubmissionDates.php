<?php

namespace App\Livewire\Cpr;

use App\Models\SubmissionDate;
use http\Message;
use Illuminate\Support\Facades\Auth;
//use Livewire\Attributes\Rule;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SubmissionDates extends Component
{
    use LivewireAlert;

//    #[Validate('required')]
//    #[Validate('date', message:'Invalid date format')]
//    #[Validate('unique:submission_dates,submission_date', message:'This date already exists.')]
    public $date = '';

    public function rules() {
        return [
            'date' => [
                'required',
                'date',
                Rule::unique('submission_dates', 'submission_date')
                    ->withoutTrashed(),
            ]
        ];
    }

    public function messages() {
        return [
            'date.required' => 'A date is required',
            'date.date' => 'Invalid date',
            'date.unique' => 'This date is already set',
        ];
    }

    public function create()
    {
//        $validated = $this->validateOnly('date');
        $this->validate();

        SubmissionDate::create([
            'submission_date' => $this->date,
            'updated_by' => Auth::user()->id,
        ]);

        $this->reset('date');

        $this->alert('success', 'Submission Date Added.', [
            'position' => 'top-end',
            'timer' => 2000,
            'showConfirmButton' => false,
            'confirmButtonColor' => '#10b981',
        ]);

//        session()->flash('success', 'Submission Date Created Successfully.');
    }

    public function delete($dateId)
    {
        try{
            SubmissionDate::findOrFail($dateId)->update([
                'deleted_by' => Auth::user()->id,
                'deleted_at' => now(),
            ]);
            $this->alert('info', 'Submission Date Deleted.', [
                'position' => 'top-end',
                'timer' => 2000,
                'showConfirmButton' => false,
                'confirmButtonColor' => '#06b6d4',
            ]);
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

    public function render()
    {
        return view('livewire.cpr.submission-dates', [
            'upcoming_dates' => SubmissionDate::with('updatedBy')
                                              ->where('submission_date', '>', now())
                                              ->orderBy('submission_date')
                                              ->get(),
        ]);
    }
}
