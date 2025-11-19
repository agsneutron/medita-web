<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\CardWS;
use App\Models\Card;
use App\Models\Client;
use Carbon\Carbon;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CardController extends Controller
{
    public function createCard(Request $request)
    {

        $cardNumber = $request->input('card_number');
        $month = $request->input('month');
        $year = $request->input('year');
        $cvv = $request->input('cvv');
        $owner = $request->input('owner');
        $stripeId = $request->input('stripeId');


        try {
            DB::beginTransaction();
            /** @var Client $client */
            $client = \Auth::user();


            if ($client->stripe_id == null) {
                $customer = new \Stripe\Customer();
                $customer->name=$client->name. ' '.$client->last_name.' '.$client->second_last_name;
                $customer->email=$client->email;
                $newCustomer = StripeService::createCustomer($customer);
                $client->stripe_id = $newCustomer->id;
                $client->saveOrFail();
            }
            //strip id $newCustomer->id

            $card = new \Stripe\Card();

            $card->number = $cardNumber;
            $card->exp_month = $month;
            $card->exp_year = $year;
            $card->cvc = $cvv;
            
            // quitar espacios o guiones
            $cardNumber = preg_replace('/\D/', '', $cardNumber);
            
            // últimos 4 dígitos
            $lastFour = substr($cardNumber, -4);

            //$newPaymentMethod = StripeService::createCustomerPaymentMethod($client->stripe_id, $card);
            //$newCard = $newPaymentMethod->card;
            $addCard = new Card();
            $addCard->active = true;
            $addCard->name_client = $owner;
            $addCard->num_target = "**** **** **** " . $lastFour; //$newCard->last4;
            $addCard->client_id = $client->id;
            $addCard->stripe_id = $stripeId; // $newPaymentMethod->id;
            $addCard->expired_date = Carbon::createFromFormat('m-Y', $month. '-' . $year);

            $addCard->saveOrFail();


            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Tarjeta creada'
            ]);


        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'line'=>$e->getLine()
            ]);
        }
    }

    public function getCards()
    {
        /** @var Client $client */
        $client = \Auth::user();

        $cards = Card::whereClientId($client->id)
            ->orderByDesc('active')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Datos obtenidos exitosamente',
            'data' => CardWS::collection($cards)
        ]);

    }

    public function activateCard(Request $request){

        $id = $request->input('id');

        /** @var Card $card */
        $card = Card::find($id);



        if (!isset($card)){
            return response()->json([
                'success' => false,
                'message' => 'Tarjeta no encontrada'
            ]);
        }
            try {
            DB::beginTransaction();

                $card->active=!$card->active;

                $card->saveOrFail();
                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Estatus de tarjeta modificado exitosamente',
                ]);

            } catch (Throwable $e){
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Ocurrio un error al modificar el estatus de tarjeta'
                ]);
            }

    }

}
