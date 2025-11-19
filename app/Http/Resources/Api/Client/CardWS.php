<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Card;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class CardWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Card $this */

        $property = [
            'id' => $this->id,
            'name_client' => $this->name_client,
            'num_target' => $this->num_target,
            'expired_date' => Carbon::parse($this->expired_date)->format('m/y'),
            'active' => $this->active,
            'brand'=>$this->brand
        ];

        return $property;
    }
}
