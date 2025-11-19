<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Institution;
use Illuminate\Http\Resources\Json\JsonResource;

class InstitutionWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Institution $this */
        $property = [
            'id' => $this->id,
            'name' => $this->name,
            'program' => $this->program_id,
        ];
        return $property;
    }
}
