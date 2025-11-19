<?php

namespace App\Http\Resources\Api\Client;

use App\Models\News;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var News $this */
        $property = [
            'id'=> $this->id,
            'title'=> $this->title,
            'url_image'=> $this->url_image != null ? asset($this->url_image) : null,
            'content'=> $this->content,
        ];

        return $property;
    }
}
