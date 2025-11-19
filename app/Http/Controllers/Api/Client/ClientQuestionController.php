<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\ClientQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class ClientQuestionController extends Controller
{
    public function registerClientAnswer(Request $request){
        $clientAnswer = $request -> input('client_answer');
        $client = \Auth::user();

        if (!isset($clientAnswer)){
            return response() -> json([
                'success' => false,
                'message' => 'Datos no proporcionados',
            ]);
        }
        try {
            DB::beginTransaction();
            $verify=$this->verifyAnswers()->getOriginalContent();
            $attempt=1;
            if ($verify['success']){
                $attempt=2;
            }

            foreach ($clientAnswer as $item){
                $answer = ClientQuestion::whereClientId($client->id)->where('question_id',$item['question_id'])->where('attempt',$attempt)->first();
                if(!isset($answer)){
                    $answer = ClientQuestion::create([
                        'client_id'=>$client -> id,
                        'question_id'=>$item['question_id'],
                        'answer_id'=>$item['answer_id'],
                        'attempt'=>$attempt
                    ]);

                }
                $answer->answer_id = $item['answer_id'];
                $answer -> saveOrFail();

            }

            DB::commit();

            return response() -> json([
                'success' => true,
                'message' => 'Acción exitosa',
            ]);
        }catch (Throwable $e){
            DB::rollback();
            return response() -> json([
                'success' => false,
                'message' =>'No se pudo completar la acción',
                'error'=>$e->getMessage().'Line:'.$e->getLine()
            ]);
        }
    }


    public function verifyAnswers($count=1):JsonResponse{
        //count number of time to verify
        //1 when is the first audio of the first phase
        //2 when is the last audio of the last phase
        //use only when program is School
        $client = \Auth::user();
        $questions=Question::where('id','!=',0)->where('educational_level_id',$client->educational_level_id)->count();
        $clientQuestion=ClientQuestion::where('client_id',$client->id)->count();
        // added one unit to match questions query, it get one extra cause the first element is the instructions
        if (($questions*$count) == $clientQuestion ){
            return response() -> json([
                'success' => true,
                'message' => 'Se completo el formulario',
            ]);
        }else{
            return response() -> json([
                'success' => false,
                'message' => 'Faltan completar formulario'
            ]);
        }
    }
}
