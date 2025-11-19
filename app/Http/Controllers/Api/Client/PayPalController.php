<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PayPalController extends Controller
{
    private $clientId;
    private $secret;
    private $baseUrl;

    public function __construct()
    {
        $this->clientId = env('PAYPAL_CLIENT_ID');
        $this->secret = env('PAYPAL_SECRET');
        $this->baseUrl = env('PAYPAL_BASE_URL', 'https://api-m.sandbox.paypal.com'); // cambia a live en prod
    }

    private function getAccessToken()
    {
        $response = Http::asForm()->withBasicAuth($this->clientId, $this->secret)
            ->post("{$this->baseUrl}/v1/oauth2/token", [
                'grant_type' => 'client_credentials',
            ]);

        return $response->json()['access_token'] ?? null;
    }

    public function createOrder2(Request $request)
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)->post("{$this->baseUrl}/v2/checkout/orders", [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'MXN',
                    'value' => $request->amount,
                ],
                'description' => 'Compra en Medita México'
            ]],
            'application_context' => [
                'return_url' => url('/paypal/return'),
                'cancel_url' => url('/paypal/cancel')
            ]
        ]);

        return response()->json($response->json());
    }
    
    public function createOrder(Request $request)
    {
        $token = $this->getAccessToken();
    
        $response = Http::withToken($token)->acceptJson()->post("{$this->baseUrl}/v2/checkout/orders", [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'MXN',
                    'value' => $request->amount,
                ],
                'description' => 'Compra en Medita México'
            ]],
            'application_context' => [
                'return_url' => url('/paypal/return'),
                'cancel_url' => url('/paypal/cancel')
            ]
        ]);
    
        $body = $response->body();
        
        // Convertir a array PHP
        $json = json_decode($body, true);
    
        // Buscar el link "approve"
        $approvalUrl = null;
        if (isset($json['links']) && is_array($json['links'])) {
            foreach ($json['links'] as $link) {
                if (isset($link['rel']) && $link['rel'] === 'approve') {
                    $approvalUrl = $link['href'] ?? null;
                    break;
                }
            }
        }
    
        // Devolver en el formato que espera Android
        return response()->json([
            'approval_url' => $approvalUrl,
            'order' => $json
        ]);
    }

    public function captureOrder(Request $request)
    {
        $token = $this->getAccessToken();

        $orderId = $request->orderId;

        $response = Http::withToken($token)->acceptJson()->withBody('', 'application/json')->post("{$this->baseUrl}/v2/checkout/orders/{$orderId}/capture");

        //return response()->json($response->json());
        $body = $response->body();
        
        // Convertir a array asociativo
        $data = json_decode($body, true);
        
        return response()->json([
            'status' => $data['status'] ?? null,
            'detail' => $data,
        ]);
    }
    
    public function handleReturn(Request $request)
    {
        $token = $this->getAccessToken();
        $orderId = $request->query('token'); // PayPal manda ?token=ORDER_ID
    
        if (!$orderId) {
            return response()->json(['error' => 'Token no recibido'], 400);
        }
    
        // Capturar la orden en PayPal
        $response = Http::withToken($token)->post("{$this->baseUrl}/v2/checkout/orders/{$orderId}/capture");
    
        $data = $response->json();
    
        if (isset($data['status']) && $data['status'] === 'COMPLETED') {
            // Aquí puedes guardar en tu BD que el pago fue exitoso
            return response()->json([
                'success' => true,
                'message' => 'Pago completado correctamente',
                'data' => $data
            ]);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'El pago no se completó',
            'data' => $data
        ]);
    }
    
    public function handleCancel()
    {
        // Aquí puedes manejar si el usuario canceló
        return response()->json([
            'success' => false,
            'message' => 'El usuario canceló el pago'
        ]);
    }

}
