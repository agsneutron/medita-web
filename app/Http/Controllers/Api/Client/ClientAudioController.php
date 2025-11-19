<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientAudio;
use App\Models\ClientPhase;
use App\Models\EducationalLevel;
use App\Models\Evaluation;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientAudioController extends Controller
{

    function updateClientAudioDuration($clientAudio)
    {
        $clientAudio->completed = true;
        $clientAudio->duration = $clientAudio->audio->duration;

        $clientAudio->save();
    }

    public function registerAudio(Request $request)
    {
        $audioId = $request->input('audio_id');
        $client = \Auth::user();

        $clientAudioExist = ClientAudio::whereAudiosId($audioId)
            ->whereClientId($client->id)
            ->first();

        if (isset($clientAudioExist)) {
            try {
                $this->updateClientAudioDuration($clientAudioExist);

                return response()->json([
                    'success' => true,
                    'message' => 'Acción exitosa',
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se ha podido completar la acción: ' . $e->getMessage() . ' Line: ' . $e->getLine()
                ]);
            }

        }

        try {
            DB::beginTransaction();

            $date = Carbon::now();

            $audio = Audio::whereId($audioId)->first();

            $clientAudio = new ClientAudio();
            $clientAudio->client_id = $client->id;
            $clientAudio->audios_id = $audioId;
            $clientAudio->completed = true;
            $clientAudio->duration = $audio->duration;
            $clientAudio->created_at = $date;
            $clientAudio->updated_at = $date;
            $clientAudio->saveOrFail();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Acción exitosa',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'No se ha podido completar la acción: ' . $e->getMessage() . ' Line: ' . $e->getLine()
            ]);
        }
    }

    public function getProgress()
    {
        /** @var Client $client */
        $client = \Auth::user();
        $level = $client->educational_level_id;

        $totalAudios = Program::whereActive(true)->with(['categories'=>function($q) use($level,$client){
            if (isset($level)){
                $categoryClient =[$this->getCategory($level)];
                $q->where('active',true)->whereIn('category_id',$categoryClient);
            }elseif ($client->teacher && $client->program_id == Program::LIFEFULLNESS){
                $q->where('active',true)->whereNotIn('category_id',[Category::LIFE_FULLNESS_UNIVERSITY,Category::HIGH_TECH_AUDIO,Category::RECOGNITIONS_PROGRAM,Category::MEDITATIONS_GUIDED]);
            }else{
                $q->where('active',true)->whereNotIn('category_id',[Category::HIGH_TECH_AUDIO,Category::RECOGNITIONS_PROGRAM]);
            }

        },'categories.phases'=>function($q){
            $q->where('active',true);
        },'categories.phases.audio'=>function($q){
            $q->where('active',true);
        }])->find($client->program_id);
        $totalAudio=0;
        foreach ($totalAudios->categories as $category){
            foreach ($category->phases as $phase){
                $totalAudio+=$phase->audio->count();
            }
        }
        $clientAudio=ClientAudio::whereClientId($client->id)->whereHas('audio.phase',function($q) use($level,$client){
            if (isset($level)){
                $categoryClient =[$this->getCategory($level)];
                $q->where('active',true)->whereIn('category_id',$categoryClient);
            }elseif ($client->teacher && $client->program_id == Program::LIFEFULLNESS){
                $q->where('active',true)->whereNotIn('category_id',[Category::LIFE_FULLNESS_UNIVERSITY,Category::HIGH_TECH_AUDIO,Category::RECOGNITIONS_PROGRAM,Category::MEDITATIONS_GUIDED]);
            }else{
                $q->where('active',true)->whereNotIn('category_id',[Category::HIGH_TECH_AUDIO,Category::RECOGNITIONS_PROGRAM]);
            }

        },'>',0)
            ->whereHas('audio',function($q){
                $q->where('active',true);
            },'>',0);
        $countCompleteAudio =$clientAudio->count();

        $completeAudio = $clientAudio->get();
        $totalMinutes = 0;

        foreach ($completeAudio as $clientAudio) {
            /** @var ClientAudio $clientAudio */
            $totalMinutes = $totalMinutes + (intval($clientAudio->audio->duration) * 1000);

        }

        $ratingAvg=Evaluation::whereClientId($client->id)->select('score')->get()->average->score;

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => [
                'total_audios' => $totalAudio,
                'completed_audios' => $countCompleteAudio,
                'total_minutes' => $totalMinutes,
                'rating'=>$ratingAvg
            ]
        ]);
    }

    public function registerPhaseClient(Request $request)
    {
        try {
            \DB::beginTransaction();
            $client = \Auth::user();
            $phaseId = $request->input('phase_id');

            $clientPhase = ClientPhase::whereClientId($client->id)->where('phase_id',$phaseId)->first();
            if(!isset($clientPhase)){
                $clientPhase = new ClientPhase();
                $clientPhase->phase_id = $phaseId;
                $clientPhase->client_id = $client->id;
                $clientPhase->saveOrFail();
            }

            \DB::commit();

            return response()->json([
               'success' => true,
               'message' => 'Fase registrada correctamente'
            ]);

        }catch (\Throwable $exception){
            \DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'No se pudo registrar la fase',
                'error'=>$exception->getMessage()
            ]);
        }
    }

    public function progress()
    {
            $client = \Auth::user();

            $clientPhases = ClientPhase::whereClientId($client->id)->pluck('phase_id');
            $totalAudios = Audio::whereIn('phase_id', $clientPhases)->get()->count();
            $audiosPlayedByClient = ClientAudio::whereClientId($client->id)->whereHas('audio',function ($q) use ($clientPhases){
                $q->whereIn('phase_id', $clientPhases);
            })->get();


            $ratingAvg=Evaluation::whereClientId($client->id)->select('score')->get()->average->score;
                $countCompleteAudio = $audiosPlayedByClient->where('completed', true)->count();
                $completeAudio = $audiosPlayedByClient;
                $totalMinutes = 0;
                foreach ($completeAudio as $clientAudio) {
                    /** @var ClientAudio $clientAudio */
                    if ($clientAudio->completed) {
                        $totalMinutes = $totalMinutes + (intval($clientAudio->audio->duration) * 1000);
                    } else {
                        $totalMinutes += (intval($clientAudio->duration) * 1000);
                    }
                }
            return response()->json([
                    'success' => true,
                    'message' => 'Datos obtenidos exitosamente',
                    'data' => [
                        'total_audios' => $totalAudios,
                        'completed_audios' => $countCompleteAudio,
                        'total_minutes' => $totalMinutes,
                        'rating' => $ratingAvg,
                        'phases' => $clientPhases
                    ]
                ]);
    }
    public function getCategory($idEducationLevel):int{
        switch ($idEducationLevel){
            case EducationalLevel::KINDERGARTEN:
                return 2;
            case EducationalLevel::PRIMARY:
                return 3;
            case EducationalLevel::SECONDARY:
                return 4;
            case EducationalLevel::HIGH_SCHOOL:
                return 5;
            case EducationalLevel::UNIVERSITY:
                return 6;
            default:
                return 0;
        }
    }
}
