<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\InstitutionWS;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    public function validateCode($code){


        if (!isset($code)){
            return response()->json([
                'success' => false,
                'message' => 'Codigo no proporcionado'
            ]);
        }


        $institution = Institution::whereActive(true)->whereCode($code)->first();

        if (!isset($institution)){
            return response()->json([
                'success' => false,
                'message' => 'Codigo inválido'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenido exitosamente',
            'data' => new InstitutionWS($institution)
        ]);

    }
}
