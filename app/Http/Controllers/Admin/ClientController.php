<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\EducationalLevel;
use App\Models\Gender;
use App\Models\Institution;
use App\Models\Level;
use App\Models\Payment;
use App\Models\Program;
use DB;
use Carbon\Carbon;
use http\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function indexContent(Request $request)
    {
        $page = $request->get('page', 0);
        $size = $request->get('size', 30);
        $skip = $page * $size;

        $filterName = $request->get('filter-name', null);
        $filterEmail = $request->get('filter-email', null);
        $filterAge = $request->get('filter-age', null);
        $filterGender = $request->get('filter-gender', null);

        $query = Client::orderBy('id', 'asc')
            ->with([
                    'gender',
                    'educational_level',
                    'evaluations',
                    'program.categories' => function($q){
                        //Sólo tomar en cuneta audios de Meditaciones guiadas
                        $q->where('categories.id','=',Category::MEDITATIONS_GUIDED);
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

        if ($filterName !== null) {
            $query = $query->where(function($query) use($filterName) {
                $query->where('name', 'like', '%' . $filterName . '%')
                    ->orWhere('last_name', 'like', '%' . $filterName . '%')
                    ->orWhere('second_last_name', 'like', '%' . $filterName . '%');
            });
        }

        if ($filterEmail !== null) {
            $query = $query->where('email', 'like', '%' . $filterEmail . '%');
        }

        if ($filterAge !== null) {
            $query = $query->where('age', 'like', '%' . $filterAge . '%');
        }

        if ($filterGender !== null) {
            $query = $query->where('gender_id', 'like', '%' . $filterGender . '%');
        }

        $count = $query->count();
        $client = $query
            ->limit($size)
            ->skip($skip)
            ->get();

        $genders = Gender::query()->get();
        $programs = Program::query()->get();
        $institutions = Institution::query()->get();
        $educational_levels = EducationalLevel::query()->get();
        $levels = Level::query()->get();


        return response()->json([
            'page' => $page,
            'size' => $size,
            'count' => $count,
            'data' => $client,
            'genders' => $genders,
            'programs' => $programs,
            'institutions' => $institutions,
            'educational_levels' => $educational_levels,
            'levels' => $levels,
        ]);
    }

    public function upsert(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            if ($id !== 'FAKE_ID') $client = Client::find($id);
            else
            {
                $client = Client::whereEmail($request->email);
                if ($client->count()>0){

                    return response()->json([
                        'success' => false,
                        'message' => 'correo duplicado',
                        'email' => $request->email
                    ]);

                }
                else {
                    $client = new Client();
                }

            }
            $client->fill($request->all());
            if (isset($request->password)) $client->password = bcrypt($request->password);
            $client->saveOrFail();

            if($id == 'FAKE_ID' && $request->program_id == Program::LIFEFULLNESS){
                $newClient = Client::orderBy('id', 'desc')->first();
                self::setFreeLifefullnessAudios($newClient);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cliente correcto'
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);
        }
    }

    public static function setFreeLifefullnessAudios (Client $client){
        foreach (Client::freeLifefullnessAudios as $audioID) {
            self::savePaymentFree($client->id, $audioID);
        }
        if ($client->teacher == 1){
            foreach (Client::freeLifefullnessAudiosTeacher as $audioID) {
                self::savePaymentFree($client->id, $audioID);
            }
        }
    }

    private static function savePaymentFree(int $client_id, int $audio_id)
    {
        $payment = new Payment();
        $payment->client_id = $client_id;
        $payment->audios_id = $audio_id;
        $payment->date = Carbon::today()->format('Y-m-d');
        $payment->payment_method = 'PayPal';
        $payment->price = 0;
        $payment->active = true;
        $payment->programs_id = Program::LIFEFULLNESS;
        $payment->saveOrFail();
    }

    public function status($id)
    {
        try {
            DB::beginTransaction();
            $changeStatus = Client::find($id);
            $changeStatus->active = !$changeStatus->active;
            $changeStatus->save();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Correctamente actualizado.'
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);
        }
    }

    public function getClient($id)
    {
        $client = Client::find($id);
        if ($client != null) {
            return response()->json([
                'success' => true,
                'client' => $client
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error client'
            ]);
        }
    }
}
