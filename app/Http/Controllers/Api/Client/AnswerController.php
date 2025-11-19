<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function getAnswers(){
        $answers = Answer::get();
        return response() ->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => $answers
        ]);
    }
}
