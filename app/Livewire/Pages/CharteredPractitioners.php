<?php

namespace App\Livewire\Pages;

use App\Models\Prices;
//use App\Models\User;
//use Livewire\Attributes\Title;
use App\Models\PublicDocument;
use Livewire\Component;
use Livewire\WithPagination;

class CharteredPractitioners extends Component
{
    use WithPagination;

    public $title;
    public $description;
    public $current_registration_fee;
    public $current_submission_fee;
    public $eoi_form_document;
    public $eoi_guide_document;
    public $assessment_criteria_document;
    public $appendix_document;
    public $definitions_document;
    public $appeals_document;

    public function mount()
    {
        $this->title = "Chartered Practitioners";
        $this->description = "The Worshipful Company of Environmental Cleaners Chartered Practitioners Register (CPR)";
        $this->getRegistrationFee();
        $this->getSubmissionFee();
        $this->getEoIForm();
        $this->getEoIGuide();
        $this->getAssessmentCriteria();
        $this->getAppendix();
        $this->getDefinitions();
        $this->getAppeals();
    }

    public function getEoIForm()
    {
        $this->eoi_form_document = PublicDocument::where('doc_type', 'Expression of Interest form')
                                                 ->first();
    }

    public function getEoIGuide()
    {
        $this->eoi_guide_document = PublicDocument::where('doc_type', 'Guide for Expression of Interest')
                                                  ->first();
    }

    public function getAssessmentCriteria()
    {
        $this->assessment_criteria_document = PublicDocument::where('doc_type', 'Assessment Criteria')
                                                            ->first();
    }

    public function getAppendix()
    {
        $this->appendix_document = PublicDocument::where('doc_type', 'Appendix to Assessment Criteria')
                                                 ->first();
    }

    public function getDefinitions()
    {
        $this->definitions_document = PublicDocument::where('doc_type', 'Definitions')
                                                    ->first();
    }

    public function getAppeals()
    {
        $this->appeals_document = PublicDocument::where('doc_type', 'Appeals Procedure')
                                                ->first();
    }

    public function getRegistrationFee()
    {
        $this->current_registration_fee = Prices::where('price_type', 'registration')
                                        ->where('start_date', '<=', now())
                                        ->where(function($query) {
                                            $query->where('end_date', '>', now())
                                                  ->orWhere('end_date', null);
                                        })
                                        ->orderBy('start_date')
                                        ->first();
    }

    public function getSubmissionFee()
    {
        $this->current_submission_fee = Prices::where('price_type', 'submission')
                                      ->where('start_date', '<=', now())
                                      ->where(function($query) {
                                          $query->where('end_date', '>', now())
                                                ->orWhere('end_date', null);
                                      })
                                      ->orderBy('start_date')
                                      ->first();
    }

    public function render()
    {
        return view('livewire.pages.chartered-practitioners')
            ->layout('layouts.front', [
                'title'       => $this->title,
                'description' => $this->description,
            ]);
    }

}
