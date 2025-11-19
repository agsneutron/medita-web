<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LFUEducationFirstQuestionnaire implements FromView
{
    protected $educational_level = 0, $filterName, $filterLastName, $filterSecondLastName,
            $filterEmail, $filterInstitution, $filterEducationalLevel;

    public function __construct(int $educational_level,$filterName, $filterLastName, $filterSecondLastName,
                                                       $filterEmail, $filterInstitution, $filterEducationalLevel) {
        $this->educational_level = $educational_level;
        $this->filterName = $filterName;
        $this->filterLastName = $filterLastName;
        $this->filterSecondLastName = $filterSecondLastName;
        $this->filterEmail = $filterEmail;
        $this->filterInstitution = $filterInstitution;
        $this->filterEducationalLevel = $filterEducationalLevel;
    }

    private function getReportData(){
        $educationalLevelID = $this->educational_level;
        $filterName = $this->filterName;
        $filterLastName = $this->filterLastName;
        $filterSecondLastName = $this->filterSecondLastName;
        $filterEmail = $this->filterEmail;
        $filterInstitution = $this->filterInstitution;
        $filterEducationalLevel = $this->filterEducationalLevel;

        $educationalLevelQuestions = Question::select('id')->where('educational_level_id', $educationalLevelID)->get();

        $clients = Client::orderBy('id', 'asc')
            ->where('educational_level_id', '!=',  null)
            ->where('institution_id', '!=',  null)
            ->whereHas('questions',function ($q) use($educationalLevelQuestions) {
                $q->whereIn('question_id', $educationalLevelQuestions)
                    ->where('attempt', 1);
            })
            ->with(['institution', 'educational_level'])
            ->with(['client_question' => function ($q) use($educationalLevelQuestions) {
                $q->where('attempt', 1)
                    ->whereIn('question_id', $educationalLevelQuestions)
                    ->with(['answer', 'question'])
                    ->orderBy('question_id', 'asc');
            }]);

        if ($filterName !== null) {
            $clients = $clients->where('name', 'like', '%' . $filterName . '%');
        }

        if ($filterLastName !== null) {
            $clients = $clients->where('last_name', 'like', '%' . $filterLastName . '%');
        }

        if ($filterSecondLastName !== null) {
            $clients = $clients->where('second_last_name', 'like', '%' . $filterSecondLastName . '%');
        }

        if ($filterEmail !== null) {
            $clients = $clients->where('email', 'like', '%' . $filterEmail . '%');
        }

        if ($filterEducationalLevel !== null) {
            $clients = $clients->where('educational_level_id', $filterEducationalLevel);
        }

        if ($filterInstitution !== null) {
            $clients->whereHas('institution', function($q) use($filterInstitution){
                $q->where("name", 'like', '%' . $filterInstitution . '%');
            });
        }

        return $clients->get();
    }

    private function getEducationalLevelTotalQuestions()
    {
        $educationalLevelID = $this->educational_level;
        $educationalLevelQuestions = Question::select('id')->where('educational_level_id', $educationalLevelID)->get();
        $educationalLevelTotalQuestions = count($educationalLevelQuestions);
        return $educationalLevelTotalQuestions;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('admin.reports.LFUEducationFirstQuestionnaire', [
            'clients' => $this->getReportData(),
            'totalQuestions' => $this->getEducationalLevelTotalQuestions()
        ]);
    }
}


