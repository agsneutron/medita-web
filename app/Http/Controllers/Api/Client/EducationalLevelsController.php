<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\LevelWS;
use App\Models\EducationalLevel;
use App\Models\Level;
use Illuminate\Http\Request;

class EducationalLevelsController extends Controller
{
    public function educationLevel()
    {
        $educationLevel = EducationalLevel::get();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => $educationLevel,
        ]);
    }

    public function level($educationalLevel)
    {
        $level = Level::whereEducationalLevelId($educationalLevel)
            ->where('deleted_at', null)
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => LevelWS::collection($level),
        ]);
    }


}
