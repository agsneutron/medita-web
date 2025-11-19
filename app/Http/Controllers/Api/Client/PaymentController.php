<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\AudioWS;
use App\Http\Resources\Api\Client\ContributionWS;
use App\Http\Resources\Api\Client\PaymentWS;
use App\Http\Resources\Api\Client\ShoppingCartWS;
use App\Models\Audio;
use App\Models\Card;
use App\Models\Client;
use App\Models\Payment;
use App\Models\Phase;
use App\Models\ShoppingCar;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    const CARD = 1;
    const PAYPAL = 2;

    public function makeContribution(Request $request)
    {
        $cardId = $request->input('card_id');
        $paypal = $request->get('token',null);
        $productList = $request->get('product_list',[]);
        $phasesList = $request->get('phases_list',[]);
        $isShoppingCart = $request->input('is_shopping_cart', false);
        $cvv = $request->input('cvv');
        $paymentMethod = $request->input('payment_method');
        $client = \Auth::user();


        /** @var Card $card */
        if ($paymentMethod == PaymentController::CARD) {

            $card = Card::whereId($cardId)->first();
            if (!isset($card)) {

                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró la tarjeta'
                ]);

            }
        }

        try {
            DB::beginTransaction();

            if ($paymentMethod == PaymentController::CARD){
                $totalToPay = $this->totalToPay($productList);
                $totalToPay +=  $this->totalToPayPhase($phasesList);
                $attach = StripeService::attachPaymentMethod($client->stripe_id, $card->stripe_id);
                //$token = StripeService::updateCVV($cvv);
                $stripePayment = StripeService::cretePaymentIntent($client->stripe_id, $totalToPay, $card->stripe_id );   //, $token//total ajustar  descuento

                if (!isset($stripePayment)) {
                    DB::rollBack();
                    return response()->json([
                        'success' => false,
                        'message' => 'No se pudo procesar el pago'
                    ]);
                }
            }
            $token="";
            if($paymentMethod == PaymentController::CARD){
                $token=$stripePayment->id;

            }else{
                $token = $paypal;
            }
            $this->createPayments($client,$paymentMethod,$productList,$token,isset($card)?$card->id:null);
            $this->createPaymentsPhase($client,$paymentMethod,$phasesList,$token,isset($card)?$card->id:null);
            //Delete items

            $this->deleteItems($client, $productList,$phasesList);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaccion exitosa',
            ]);


        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'ERROR: ' . $e->getCode() . ' -> ' . $e->getMessage(),
                'line'=>$e->getLine(),
                'trace'=>$e->getTrace()
            ]);
        }


    }

    /**
     * @throws \Exception
     */
    private function createPayments($client, $paymentMethod, $productList, $token, $cardId)
    {
        /** @var Client $client */
        try{
            \DB::beginTransaction();
        foreach ($productList as $item) {
            /** @var Audio $audio */
            $audio = Audio::whereId($item)->first();
            if (isset($audio)){
                $payment = new Payment();
                $payment->client_id = $client->id;
                $payment->audios_id = $audio->id;
                $payment->date = Carbon::today()->format('Y-m-d');
                $payment->payment_method = $paymentMethod == PaymentController::CARD ? 'Tarjeta de débito': 'PayPal';
                $payment->price = $audio->price;// falta
                $payment->active = true;
                $payment->programs_id = $client->program->id;
                $payment->card_id=$cardId;
                $payment->token=$token;
                $payment->saveOrFail();
                \DB::commit();
            }

            $childrenAudio=Audio::where('audio_id',$audio->id)->get();
            foreach ( $childrenAudio as $childAudio){
                $payment = new Payment();
                $payment->client_id = $client->id;
                $payment->audios_id = $childAudio->id;
                $payment->date = Carbon::today()->format('Y-m-d');
                $payment->payment_method = $paymentMethod == PaymentController::CARD ? 'Tarjeta de débito': 'PayPal';
                $payment->price = $audio->price;// falta
                $payment->active = true;
                $payment->programs_id = $client->program->id;
                $payment->card_id=$cardId;
                $payment->token=$token;
                $payment->saveOrFail();
                \DB::commit();
            }
        }
            \DB::commit();
        }catch (\Exception $ex){
            \DB::rollback();
            \Log::debug("---------Error------ Create Payments");
            \Log::debug($ex->getMessage());
            \Log::debug($ex->getLine());
            \Log::debug($ex->getFile());
            throw new \Exception($ex->getMessage());
        }
    }
    private function createPaymentsPhase($client, $paymentMethod, $phaseList, $token, $cardId)
    {
        /** @var Client $client */
        try{
            \DB::beginTransaction();
            foreach ($phaseList as $item) {
                /** @var Phase $phase */
                $phase = Phase::whereId($item)->first();
                if (isset($phase)){
                    $payment = new Payment();
                    $payment->client_id = $client->id;
                    $payment->phase_id = $phase->id;
                    $payment->date = Carbon::today()->format('Y-m-d');
                    $payment->payment_method = $paymentMethod == PaymentController::CARD ? 'Tarjeta de débito': 'PayPal';
                    $payment->price = $phase->price;// falta
                    $payment->active = true;
                    $payment->programs_id = $client->program->id;
                    $payment->card_id=$cardId;
                    $payment->token=$token;
                    $payment->saveOrFail();
                    \DB::commit();
                }
            }
            \DB::commit();
        }catch (\Exception $ex){
            \DB::rollback();
            \Log::debug("---------Error------ Create Payments");
            \Log::debug($ex->getMessage());
            \Log::debug($ex->getLine());
            \Log::debug($ex->getFile());
            throw new \Exception($ex->getMessage());
        }
    }

    private function totalToPay($productList)
    {
        $total = 0.0;
        foreach ($productList as $item) {
            /** @var Audio $audio */
            $audio = Audio::whereId($item)->first();
           $total = $total + $audio->price;
        }

        return $total;
    }
    private function totalToPayPhase($phaseList)
    {
        $total = 0.0;
        foreach ($phaseList as $item) {
            /** @var Phase $phase */
            $phase = Phase::whereId($item)->first();
            $total = $total + $phase->price;
        }

        return $total;
    }

    /**
     * @throws \Exception
     */
    private function deleteItems($client, $productList,$phasesList)
    {
        try{
            \DB::beginTransaction();

                foreach ($productList as $item) {
                    /** @var ShoppingCar $productShoppingCart */
                    ShoppingCar::whereClientId($client->id)
                        ->whereAudioId($item)
                        ->delete();

                }
            foreach ($phasesList as $item) {
                /** @var ShoppingCar $productShoppingCart */
                ShoppingCar::whereClientId($client->id)
                    ->where('phase_id',$item)
                    ->delete();

            }
                \DB::commit();


        }catch (\Exception $e){
            \DB::rollback();

            throw new \Exception($e->getMessage());
        }

    }
    function getContributions(){
        $client = \Auth::user();
        $payments=Payment::whereClientId($client->id)->where('price', '>', 0)->with(['audio','program','phase'])->get();

        $groupByDate=$payments->groupBy(function ($value){
            return $value->created_at->format('d-m-Y');
        })->all();
        $collection=collect([]);
        foreach ($groupByDate as $key=>$paymentDate){
            $audios=collect([]);
            $payments=collect([]);
            foreach ($paymentDate as $payment){
                $payments->push(new PaymentWS($payment));
                $audios->push(new ShoppingCartWS($payment));
            }

            $collection->push((object)[
                'date'=> $key,
                'audios'=> $audios,
                'payments'=>$payments
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Estas son tus aportaciones',
            'data'=> ContributionWS::collection($collection)
        ]);
    }
}
