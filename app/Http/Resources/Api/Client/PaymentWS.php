<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Audio;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Payment $this */

        $property = [
            'payment_method'=> $this->payment_method,
            'price'=> $this->price,
            'number'=> $this->payment_method == "PayPal"?(isset($this->token)?$this->token:""):(isset($this->card)?$this->card->num_target:""),
            'brand'=> $this->payment_method == "PayPal"?"paypal":(isset($this->card)?$this->card->brand:"other"),
        ];

        return  $property;
    }
}
