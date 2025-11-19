<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LFUEducation;
use App\Exports\LFUEducationFirstQuestionnaire;
use App\Exports\LFUEducationSecondQuestionnaire;
use App\Models\ClientQuestion;
use App\Models\EducationalLevel;
use App\Models\Gender;
use App\Models\Phase;
use App\Models\Question;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GeneralUsers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Institution;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{

    public function getEducationalLevels(Request $request)
    {
        $educationalLevels = EducationalLevel::all();

        return response()->json([
            'data'   => $educationalLevels,
        ]);
    }

    public function lfuFirstQuestionnaireContent(Request $request)
    {
        $status = ['Activo', 'Inactivo'];
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterInstitution = $request->get('filter-institution', null);
        $filterEducationalLevel = $request->get('filter-educational_level', null);

        $educationalLevelID = $request->get('educational_level');
        $educationalLevelQuestions = Question::select('id')->where('educational_level_id', $educationalLevelID)->get();
        $educationalLevelTotalQuestions = count($educationalLevelQuestions);

        $educationalLevels = EducationalLevel::orderBy('id', 'asc')->get();

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

        $count = $clients->count();

        $data = $clients
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page'   => $page,
            'size'   => $size,
            'count'  => $count,
            'totalQuestions' => $educationalLevelTotalQuestions,
            'educationalLevels' => $educationalLevels,
            'data'   => $data,
            'status' => $status,
        ]);
    }

    public function lfuSecondQuestionnaireContent(Request $request)
    {
        $status = ['Activo', 'Inactivo'];
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterInstitution = $request->get('filter-institution', null);
        $filterEducationalLevel = $request->get('filter-educational_level', null);

        $educationalLevelID = $request->get('educational_level');
        $educationalLevelQuestions = Question::select('id')->where('educational_level_id', $educationalLevelID)->get();
        $educationalLevelTotalQuestions = count($educationalLevelQuestions);

        $educationalLevels = EducationalLevel::orderBy('id', 'asc')->get();

        $clients = Client::orderBy('id', 'asc')
            ->where('educational_level_id', '!=',  null)
            ->where('institution_id', '!=',  null)
            ->whereHas('questions',function ($q) use($educationalLevelQuestions) {
                $q->whereIn('question_id', $educationalLevelQuestions)
                    ->where('attempt', 2);
            })
            ->with(['institution', 'educational_level'])
            ->with(['client_question' => function ($q) use($educationalLevelQuestions) {
                $q->with(['answer', 'question']);
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

        $count = $clients->count();

        $data = $clients
            ->limit($size)
            ->skip($skip)
            ->get();

        return response()->json([
            'page'   => $page,
            'size'   => $size,
            'count'  => $count,
            'totalQuestions' => $educationalLevelTotalQuestions,
            'educationalLevels' => $educationalLevels,
            'data'   => $data,
            'status' => $status,
        ]);
    }

    public function lfuEducationContent(Request $request)
    {
        $status = ['Activo', 'Inactivo'];
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterInstitution = $request->get('filter-institution', null);
        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterTeacher = $request->get('filter-teacher', null);
        $filterEducationalLevel = $request->get('filter-educational_level', null);
        $filterAge = $request->get('filter-age', null);

        $educationalLevels = EducationalLevel::orderBy('id', 'asc')->get();

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

        $count =  $clients->count();

        $data = $clients
            ->limit($size)
            ->skip($skip)
            ->get();


        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'educationalLevels' => $educationalLevels,
            'data' => $data,
            'status' => $status,
        ]);
    }

    public function generalUsersContent(Request $request)
    {
        $status = ['Activo', 'Inactivo'];
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterAge = $request->get('filter-age', null);
        $filterGender = $request->get('filter-gender', null);
        $filterPaymentsCount = $request->get('filter-payments_count', null);
        $filterPhase = $request->get('filter-phase', null);

        $genders = Gender::orderBy('id', 'asc')->get();
        $phases = Phase::orderBy('id', 'asc')->where('category_id', 1)->get();

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

        $count =  $clients->count();

        $data = $clients
            ->limit($size)
            ->skip($skip)
            ->get();


        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $data,
            'genders' => $genders,
            'phases' =>  $phases,
            'status' => $status,
        ]);
    }

    public function generalUsersExcelExport(Request $request)
    {
        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterAge = $request->get('filter-age', null);
        $filterGender = $request->get('filter-gender', null);
        $filterPaymentsCount = $request->get('filter-payments_count', null);
        $filterPhase = $request->get('filter-phase', null);
        ob_end_clean();
        return Excel::download(new GeneralUsers($filterName, $filterLastName, $filterSecondLastName, $filterEmail,
            $filterAge, $filterGender, $filterPaymentsCount, $filterPhase), "GeneralUsersReport.xlsx");
    }

    public function lfuEducationExcelExport(Request $request)
    {
        $filterInstitution = $request->get('filter-institution', null);
        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterTeacher = $request->get('filter-teacher', null);
        $filterEducationalLevel = $request->get('filter-educational_level', null);
        $filterAge = $request->get('filter-age', null);
        ob_end_clean();
        return Excel::download(new LFUEducation($filterName, $filterLastName, $filterSecondLastName, $filterEmail,
            $filterAge, $filterInstitution, $filterTeacher, $filterEducationalLevel), "lfuEducationReport.xlsx");
    }

    public function lfuEducationFirstQuestionnaireExcelExport(Request $request)
    {
        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterInstitution = $request->get('filter-institution', null);
        $filterEducationalLevel = $request->get('filter-educational_level', null);
        $educationalLevelID = $request->get('educational_level', 0);
        ob_end_clean();
        return Excel::download(new LFUEducationFirstQuestionnaire($educationalLevelID, $filterName, $filterLastName, $filterSecondLastName,
            $filterEmail, $filterInstitution, $filterEducationalLevel), "lfuEducationFirstQuestionnairReport.xlsx");
    }

    public function lfuEducationSecondQuestionnaireExcelExport(Request $request)
    {
        $filterName = $request->get('filter-name', null);
        $filterLastName = $request->get('filter-last_name', null);
        $filterSecondLastName = $request->get('filter-second_last_name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterInstitution = $request->get('filter-institution', null);
        $filterEducationalLevel = $request->get('filter-educational_level', null);
        $educationalLevelID = $request->get('educational_level', 0);
        ob_end_clean();
        return Excel::download(new LFUEducationSecondQuestionnaire($educationalLevelID, $filterName, $filterLastName, $filterSecondLastName,
            $filterEmail, $filterInstitution, $filterEducationalLevel), "lfuEducationSecondQuestionnairReport.xlsx");
    }

    private function addProgresAndPaymentsCount($data)
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
                $item->phase = $item->client_phase[0]->name;
            } else{
                $item->phase = "NO";
            }
            $item->paymentsCount = count($item->payments);
            $item->progress = $total.'%';
        }
        return $data;
    }

}
