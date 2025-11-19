<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Phase;
use Illuminate\Http\Resources\Json\JsonResource;

class RecognitionsProgramWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Phase $this */

        return [
            'id' =>  $this ->id,
            'name' =>  $this ->name,
            'url_image' =>  asset($this->url_image),
            'price'=> $this->price,
            'payment'=>!sizeof($this->payments) == 0,
            'audio_list' => AudioWS::collection($this->audio)
        ];
    }
}
