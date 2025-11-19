<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Client $this */
        $property = [
            'name' => $this->name,
            'last_name' => $this->last_name,
            'second_last_name' => $this->second_last_name,
            'url_image' => $this->url_image != null ? asset($this->url_image) : null,
            'email' => $this->email,
            'api_token' => $this->api_token,
            'program' => $this->program_id,
            'teacher' => $this->teacher,
            'gender_id' => $this->gender->id,
            'gender_name' => $this->gender->name,
            'age' => $this->age,
            'third_id' => $this->third_id,
            'educational_level'=>$this->educational_level_id,
            'phone'=>$this->phone
        ];

        return $property;
    }
}
