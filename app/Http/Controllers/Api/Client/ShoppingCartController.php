<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\ContributionWS;
use App\Http\Resources\Api\Client\ShoppingCartWS;
use App\Models\Audio;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Phase;
use App\Models\ShoppingCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    public function getShoppingCart(){
        /** @var Client $client */
        $client = \Auth::user();

        $shoppigCart = ShoppingCar::whereClientId($client->id)->with(['audio','phase'])
            ->get();


        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
           'data' => ShoppingCartWS::collection($shoppigCart),

        ]);

    }

    public function addToShoppingCart(Request $request){
        $client = \Auth::user();
        $id = $request->input('audio_id');
        $phaseId=$request->input('phase_id');
        $audio = null;
        $phase = null;
        if (isset($id)){
            $audio = Audio::whereId($id)->first();

        }elseif (isset($phaseId)){
            $phase = Phase::whereId($phaseId)->first();
            if (!isset($phase)){
                return response()->json([
                    'success' => false,
                    'message' => 'La fase no existe',
                ]);
            }
        }


        $itemExist = ShoppingCar::whereClientId($client->id);
            if (isset($audio)){
                $itemExist=$itemExist->where('audio_id',$audio->id);
            }elseif (isset($phase)){
                $itemExist=$itemExist->where('phase_id',$phase->id);
            }
        $itemExist=$itemExist->first();

        try {
            DB::beginTransaction();

            if (!isset($itemExist)){
                $shoppingCart = new ShoppingCar();
                $shoppingCart->client_id = $client->id;
                $shoppingCart->audio_id = isset($audio)?$audio->id:null;
                $shoppingCart->phase_id = isset($phase)?$phase->id:null;
                $shoppingCart->saveOrFail();

                DB::commit();
            }

            return response()->json([
                'success' => true,
                'message' => (!isset($itemExist))?'Se ha agregado al carrito correctamente':'Ya esta en el carrito'
            ]);



        }catch (Throwable $e){
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lo sentimos ocurrío un error en el servidor',
                'error'=>'ERROR: ' . $e->getCode() . ' -> ' . $e->getMessage(),
            ]);
        }

    }

    public function deleteToShoppingCart(Request $request){

        $id = $request->input('id');

        if (!isset($id)){
            return response()->json([
                'success' => false,
                'message' => 'Item no proporcionado',
            ]);
        }

        try {
            DB::beginTransaction();

            $itemToDelete = ShoppingCar::whereId($id)->first();

            if (!isset($itemToDelete)){
                return response()->json([
                    'success' => false,
                    'message' => 'Item no encontrado',
                ]);
            }

            $itemToDelete->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Item eliminado exitosamente'
            ]);



        }catch (Throwable $e){
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'ERROR: ' . $e->getCode() . ' -> ' . $e->getMessage()
            ]);
        }

    }


}
