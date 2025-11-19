<?php

namespace App\Http\Resources\Api\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class DocsWS extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'url_image' => asset($this->url),
        ];

        return $property;
    }
}
