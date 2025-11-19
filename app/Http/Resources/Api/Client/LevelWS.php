<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Level;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Level $this */
        $property = [
            'id' => $this->id,
            'name' => $this->name
        ];
        return $property;
    }
}
