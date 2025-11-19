<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationsController extends Controller
{
    public function verifyExistingEvaluation($id)
    {
        $client = \Auth::user();

        $evaluation = Evaluation::whereClientId($client->id)
            ->where('audio_id',$id)
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => isset($evaluation),
        ]);
    }

    public function registerEvaluation(Request $request)
    {
        $score = $request->input('score');
        $description = $request->get('description'," ");
        $audioId = $request->input('audio_id');
        $client = \Auth::user();

        $evaluationExist = Evaluation::whereClientId($client->id)
            ->where('audio_id',$audioId)
            ->first();

        if (isset($evaluationExist)){
            return response()->json([
                'success' => true,
                'message' => 'Ya existe un registro de evaluación',
            ]);
        }

        try {
            DB::beginTransaction();
            $evaluation = new Evaluation();
            $evaluation->client_id = $client->id;
            $evaluation->audio_id = $audioId;
            $evaluation->score = $score;
            $evaluation->description = $description;
            $evaluation->saveOrFail();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Accción completada exitosamente',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'No se ha podido completar la acción',
                'error'=>$e->getMessage()
            ]);
        }

    }
}
