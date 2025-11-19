<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getQuestions(){
        /** @var Client $user */
        $user=\Auth::user();
        //$questions = Question::get();
        $questions = Question::where('educational_level_id',$user->educational_level_id)->orWhere('id',0)->get();
        return response() ->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => $questions
        ]);
    }
}
