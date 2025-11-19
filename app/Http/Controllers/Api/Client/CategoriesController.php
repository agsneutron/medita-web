<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\CategoryWS;
use App\Models\Category;
use App\Models\Client;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function getCategory($category){
        /** @var Client $client */
        $client = \Auth::user();
        $guidedMeditations = Category::whereId($category)
            ->whereHas('programs', function ($q) use ($client) {
                $q->where('program_id', $client->program_id);
            })
            ->with(['phases'=>function($q) use($client){
                $q->where('active',true)->has('audio','>',0)->with(['payments'=>function($q) use($client){
                    $q->where('client_id',$client->id);
                }]);
                },'phases.audio'=>function($q) use($client){
                $q->where('active',true)->with(['clientAudio' => function ($query) use ($client){
                    $query->where('client_id',$client->id);
                }]);},'instructive','manual'])
            ->first();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' =>  $guidedMeditations ? new CategoryWS($guidedMeditations) : null,
        ]);
    }
    public function getCategories()
    {
        //* @var Client $client */
        $client = \Auth::user();
        //Get categories with programs that the client has in program_id

        $categories = Category::whereHas('programs', function ($q) use ($client) {
            $q->where('program_id', $client->program_id);
        })->get();
        if($client->program_id == 3 || $client->program_id == 4){
            //Filter categories if the client has program_id 3 or 4
            //show categories except 8 and 9
            $categoriesFiltered = [];
            foreach ($categories as $category){
                if($category->id != 8 && $category->id != 9){
                    $categoriesFiltered[] = $category;
                }
            }
            $categories = $categoriesFiltered;
        }

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => $categories,
        ]);
    }
}
