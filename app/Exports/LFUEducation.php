<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\EducationalLevel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LFUEducation implements FromView
{


    protected $filterName,
        $filterLastName,
        $filterSecondLastName,
        $filterEmail,
        $filterAge,
        $filterInstitution,
        $filterTeacher,
        $filterEducationalLevel;

    public function __construct($filterName, $filterLastName, $filterSecondLastName, $filterEmail,
                                $filterAge, $filterInstitution, $filterTeacher, $filterEducationalLevel) {
        $this->filterName = $filterName;
        $this->filterLastName = $filterLastName;
        $this->filterSecondLastName = $filterSecondLastName;
        $this->filterEmail = $filterEmail;
        $this->filterAge = $filterAge;
        $this->filterInstitution = $filterInstitution;
        $this->filterTeacher = $filterTeacher;
        $this->filterEducationalLevel = $filterEducationalLevel;
    }

    private function getReportData(){
        $filterName = $this->filterName;
        $filterLastName = $this->filterLastName;
        $filterSecondLastName = $this->filterSecondLastName;
        $filterEmail = $this->filterEmail;
        $filterAge = $this->filterAge;
        $filterInstitution = $this->filterInstitution;
        $filterTeacher = $this->filterTeacher;
        $filterEducationalLevel = $this->filterEducationalLevel;

        $clients = Client::orderBy('id', 'asc')
            ->where('educational_level_id', '!=',  null)
            ->where('institution_id', '!=',  null)
            ->with(['institution', 'educational_level'])
            ->with(['program.categories',
                'program.categories.phases' => function($q){
                    $q->where('active','=',true);
                },
                'program.categories.phases.audio' => function($q){
                    $q->where('active','=',true);
                },
                'client_audio.audio' => function($q){
                    $q->where('active','=',true);
                },
                'client_audio.audio.phase' => function($q){
                    $q->where('active','=',true);
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

        if ($filterAge !== null) {
            $clients = $clients->where('age', 'like', '%' . $filterAge . '%');
        }

        if ($filterEducationalLevel !== null) {
            $clients = $clients->where('educational_level_id', $filterEducationalLevel);
        }

        if ($filterTeacher !== null) {
            $clients = $clients->where('teacher', $filterTeacher);
        }

        if ($filterInstitution !== null) {
            $clients->whereHas('institution', function($q) use($filterInstitution){
                $q->where("name", 'like', '%' . $filterInstitution . '%');
            });
        }
        return $clients->get();
    }

    private function addComplementaryInfo($data)
    {
        foreach ($data as &$item) {
            $total = 0;
            $count = 0;
            $total_count = 0;
            foreach ($item->client_audio as &$audio) {
                if ($audio->completed && $audio->audio !== null)
                    if ($audio->audio->phase !== null) {
                        $count++;
                    }
            }
            foreach ($item->program->categories as &$category) {
                foreach ( $category->phases as &$phase) {
                    foreach ($phase->audio as &$audio) {
                        $total_count++;
                    }
                }
            }
            if ($total_count !== 0) {
                $total = round(($count * 100) / $total_count);
            }
            $item->progress = $total.'%';
        }
        return $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('admin.reports.LFUEducation', [
            'clients' => $this->addComplementaryInfo($this->getReportData())
        ]);
    }
}

