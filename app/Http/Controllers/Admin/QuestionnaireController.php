<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class QuestionnaireController extends Controller
{

    public function getQuestions($id){
        switch ($id){
            case 2:
                    $questions = Question::whereId(0)->orWhere('educational_level_id', 1)->get();
                    break;
            case 3:
                    $questions = Question::whereId(0)->orWhere('educational_level_id', 2)->get();
                    break;
            case 4:
                    $questions = Question::whereId(0)->orWhere('educational_level_id', 3)->get();
                    break;
            case 5:
                    $questions = Question::whereId(0)->orWhere('educational_level_id', 4)->get();
                    break;
            case 6:
                    $questions = Question::whereId(0)->orWhere('educational_level_id', 5)->get();
                    break;
            default:
                $questions = Question::whereId(0)->get();
                break;
        }

        if ($questions != null) {
            return response()->json([
                'success' => true,
                'questions' => $questions
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al encontrar las preguntas'
            ]);
        }
    }

    public function upsert(Request $request, $id)
    {
        $questions= $request->all();

        switch ($id){
            case 2:
                $educational_level_id =  1;
                break;
            case 3:
                $educational_level_id = 2;
                break;
            case 4:
                $educational_level_id = 3;
                break;
            case 5:
                $educational_level_id = 4;
                break;
            case 6:
                $educational_level_id = 5;
                break;
            default:
                $educational_level_id = null;
                break;
        }

        try {
            foreach ($questions as $id=>$description){
                DB::beginTransaction();
                $question = Question::findOrNew($id);
                $question->description = $description;
                ($id==0) ? $question->educational_level_id = null : $question->educational_level_id = $educational_level_id;
                $question->saveOrFail();
                DB::commit();
            }
            return response()->json([
                'success' => true,
                'message' => 'cuestionario correcto.'
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
                'line' => $ex->getLine(),
                'file' => $ex->getFile()
            ]);
        }
    }
}
