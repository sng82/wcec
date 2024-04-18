<?php

namespace App\Livewire\Cpr;

use App\Models\SubmissionDate;
use Illuminate\Support\Facades\Auth;
//use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SubmissionDates extends Component
{
    #[Validate('required')]
    #[Validate('date', message:'Invalid date format')]
    #[Validate('unique:submission_dates,submission_date', message:'This date already exists.')]
    public $date = '';

    public function create()
    {
        $validated = $this->validateOnly('date');

        SubmissionDate::create([
            'submission_date' => $validated['date'],
            'updated_by' => Auth::user()->id,
        ]);

        $this->reset('date');

        session()->flash('success', 'Submission Date Created Successfully.');
    }

    public function delete($dateId)
    {

//        dd($dateId);
        try{
            SubmissionDate::findOrFail($dateId)->update([
//                'deleted_at' => now(),
                'deleted_by' => Auth::user()->id,
            ]);
        } catch(\Exception $e) {
//            dd($e);
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
