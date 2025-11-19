<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Gender;
use App\Models\Institution;
use App\Models\Program;
use App\Models\TypeClient;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientInstitutionController extends Controller
{
    public function indexContent(Request $request, $id)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterAge = $request->get('filter-age', null);
        $filterGender = $request->get('filter-gender', null);

        $query = Client::whereInstitutionId($id)
            ->with([
                'gender',
                'educational_level',
                'evaluations',
                'program.categories' => function($q){
                    //Sólo tomar en cuneta audios de Meditaciones guiadas
                    $q->whereIn('categories.id',Category::LIFEFULLNESS);
                },
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
                },
            ]);

        if ($filterName != null) {
            $query = $query->where(function($query) use($filterName) {
                $query->where('name', 'like', '%' . $filterName . '%')
                    ->orWhere('last_name', 'like', '%' . $filterName . '%')
                    ->orWhere('second_last_name', 'like', '%' . $filterName . '%');
            });
        }
        if ($filterEmail != null) {
            $query = $query->where('email', 'like', '%' . $filterEmail . '%');
        }
        if ($filterAge != null) {
            $query = $query->where('age', 'like', '%' . $filterAge . '%');
        }
        if ($filterGender != null) {
            $query = $query->where('gender_id','=',$filterGender);
        }

        $count = $query->count();
        $user = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        $genders = Gender::query()->get();

        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $user,
            'genders' => $genders,
        ]);
    }
}
