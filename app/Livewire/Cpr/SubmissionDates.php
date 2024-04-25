<?php

namespace App\Livewire\Cpr;

use App\Models\SubmissionDate;
use http\Message;
use Illuminate\Support\Facades\Auth;
//use Livewire\Attributes\Rule;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubmissionDates extends Component
{
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

    public function create()
    {
//        $validated = $this->validateOnly('date');
        $this->validate();

        SubmissionDate::create([
            'submission_date' => $this->date,
            'updated_by' => Auth::user()->id,
        ]);

        $this->reset('date');

        session()->flash('success', 'Submission Date Created Successfully.');
    }

    public function delete($dateId)
    {
        try{
            SubmissionDate::findOrFail($dateId)->update([
                'deleted_by' => Auth::user()->id,
                'deleted_at' => now(),
            ]);
        } catch(\Exception $e) {
            session()->flash('error', 'Failed to find and delete item - somebody may have beaten you to it!');
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
