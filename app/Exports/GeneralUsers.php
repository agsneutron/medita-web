<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\Gender;
use App\Models\Phase;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GeneralUsers implements FromView
{
        protected $filterName,
            $filterLastName,
            $filterSecondLastName,
            $filterEmail,
            $filterAge,
            $filterGender,
            $filterPaymentsCount,
            $filterPhase;

        public function __construct($filterName, $filterLastName, $filterSecondLastName, $filterEmail,
                                    $filterAge, $filterGender, $filterPaymentsCount, $filterPhase) {
            $this->filterName = $filterName;
            $this->filterLastName = $filterLastName;
            $this->filterSecondLastName = $filterSecondLastName;
            $this->filterEmail = $filterEmail;
            $this->filterAge = $filterAge;
            $this->filterGender = $filterGender;
            $this->filterPaymentsCount = $filterPaymentsCount;
            $this->filterPhase = $filterPhase;
        }

        private function getReportData(){

            $filterName = $this->filterName;
            $filterLastName = $this->filterLastName;
            $filterSecondLastName = $this->filterSecondLastName;
            $filterEmail = $this->filterEmail;
            $filterAge = $this->filterAge;
            $filterGender = $this->filterGender;
            $filterPaymentsCount = $this->filterPaymentsCount;
            $filterPhase = $this->filterPhase;

            $clients = Client::orderBy('id', 'asc')
                ->with(['gender'])
                ->with(['payments'])
                ->with(['client_phase' => function($q){
                    $q->orderBy('id', 'asc')->with(['phase']);
                }
                ])
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
            if ($filterGender !== null) {
                $clients = $clients->where('gender_id', $filterGender);
            }
            if ($filterPaymentsCount !== null) {
                $clients->has('payments', '=', $filterPaymentsCount);
            }
            if ($filterPhase !== null) {
                $clients->whereHas('client_phase', function($q) use($filterPhase){
                    $q->orderBy('id', 'desc')->where("phase_id", $filterPhase);
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
                if(count($item->client_phase) > 0){
                    $item->phase = $item->client_phase[0]->phase->name;
                } else{
                    $item->phase = "NO";
                }
                $item->paymentsCount = count($item->payments);
                $item->progress = $total.'%';
            }
            return $data;
        }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('admin.reports.GeneralUsers', [
            'clients' => $this->addComplementaryInfo($this->getReportData())
        ]);
    }
}
