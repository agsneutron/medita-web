<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Audio;
use App\Models\Payment;
use Illuminate\Http\Resources\Json\JsonResource;

class ContributionWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


        $property = [
            'date' => $this->date,
            'audios'=> $this->audios,
            'payments'=>$this->payments
        ];

        return  $property;
    }
}
