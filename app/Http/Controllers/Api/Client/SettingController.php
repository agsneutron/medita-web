<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getTerms(){
        $terms = Setting::whereId(Setting::TERMS)->first();

        if($terms == null){
            return response() -> json([
                'success'=>false,
                'message'=> 'No se encontraron datos',
                'data'=>$terms
            ]);
        }

        return response()->json([
            'success'=>true,
            'message'=> 'Datos obtenidos exitosamente',
            'data'=>$terms
        ]);
    }

    public function getPrivacy(){
        $privacy = Setting::whereId(Setting::PRIVACY)->first();

        if($privacy == null){
            return response() -> json([
                'success'=>false,
                'message'=> 'No se encontraron datos',
                'data'=>$privacy
            ]);
        }

        return response()->json([
            'success'=>true,
            'message'=> 'Datos obtenidos exitosamente',
            'data'=>$privacy
        ]);
    }
    //
}
