<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\NewsWS;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getNews(){
        $news = News::where('active', true)->get();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' =>  NewsWS::collection($news)
        ]);
    }
}
