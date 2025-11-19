<?php


namespace App\Services;


use App\Models\Client;
use Stripe\Card;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeService
{
    /**
     * @param Customer $customer
     * @throws ApiErrorException
     * @return Customer new Stripe Customer created
     */
    public static function createCustomer(Customer $customer)
    {
        Stripe::setApiKey(env("STRIPE_SECRET_KEY"));
        return Customer::create($customer->toArray());
    }


    /**
     * @param String $customerId
     * @param Card $card
     * @param  $attachCard
     * @return PaymentMethod
     * @throws ApiErrorException
     */
    public static function createCustomerPaymentMethod(String $customerId, Card $card)
    {
        Stripe::setApiKey(env("STRIPE_SECRET_KEY"));
        $payment = PaymentMethod::create([
            'type' => 'card',
            'card' => $card->toArray()
        ]);
        $stripe = new \Stripe\StripeClient(env("STRIPE_SECRET_KEY"));
        $stripe->paymentMethods->attach(
            $payment->id,
            [
                'customer' => $customerId
            ]
        );
        return $payment;
    }

    public static function createPlaceHold(String $customerId, $price, String $paymentMethodId)
    {
        Stripe::setApiKey(env("STRIPE_SECRET_KEY"));
        $paymentIntent = PaymentIntent::create([
            'amount' => $price,
            'currency' => 'mxn',
            'payment_method_types' => ['card'],
            'customer' => $customerId,
            'payment_method' => $paymentMethodId,
        ]);
        return $paymentIntent;
    }

    public static function processError(ApiErrorException $e)
    {
        \Log::error($e);
        $code = 501;
        $message = "OcurriÃ³ un error al generar el pago, verifique su tarjeta, o comuniquese con su banco";
        $data = $e;
        switch ($e->getError()->code) {
            case "expired_card":
                $message = "Su Tarjeta se encuentra expirada";
                break;
            case "incorrect_number":
            case "incorrect_cvc":
            case "card_declined":
                $message = "Su tarjeta fue rechazada";
                break;
            case "processing_error":
                $message = "Se produjo un error al procesar su tarjeta. IntÃ©ntalo de nuevo en un momento.";
                break;
        }

        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data,
            'code' => $code
        ]);
    }


    public static function cretePaymentIntent($customerId, $price, $cardId) // , $token = null
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        return PaymentIntent::create([
            'amount' => $price * 100,
            'currency' => 'mxn',
            'customer' => $customerId,
            'payment_method' => $cardId,
            'confirm' => true,
            'payment_method_types' => ['card'],
            //'payment_method_options' => [
            //    'card' => [
            //        'cvc_token' => $token ? $token->id : null
            //    ]
            //]
        ]);
        /*return PaymentIntent::create([
            'amount' => $price * 100,
            'currency' => 'mxn',
            'payment_method_types' => ['card'],
            'customer' => $customerId,
            'payment_method' => $cardId,
            'confirm' => true,
            'payment_method_options' => ['card' => ['cvc_token' => $token]]
        ]);*/
    }


    public static function updateCVV($cvv) {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        return $stripe->tokens->create([
            'cvc_update' => ['cvc' => $cvv]
        ]);
    }
    
    public static function attachPaymentMethod($customerId, $paymentMethodId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        // Primero verificamos si ya est¨¢ adjunto
        $paymentMethods = \Stripe\PaymentMethod::all([
            'customer' => $customerId,
            'type' => 'card',
        ]);

        foreach ($paymentMethods->data as $pm) {
            if ($pm->id === $paymentMethodId) {
                return $pm; // ya estaba adjunto
            }
        }

        // Si no estaba, lo adjuntamos
        return $stripe->paymentMethods->attach(
            $paymentMethodId,
            ['customer' => $customerId]
        );
    }
    
    public static function getCard($stripePaymentMethodId){
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        return $stripe->paymentMethods->retrieve(
            $stripePaymentMethodId,
            []
        );
    }


}
