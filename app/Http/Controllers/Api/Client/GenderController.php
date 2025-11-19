<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public function getGenders(){
        $genders = Gender::get();
        return response()->json([
            'success' => false,
            'message' => 'Datos obtenidos exitosamente',
            'data' =>  $genders
        ]);
    }
}
