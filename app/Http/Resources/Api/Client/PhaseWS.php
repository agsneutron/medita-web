<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Phase;
use Illuminate\Http\Resources\Json\JsonResource;

class PhaseWS extends JsonResource
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
        $isComplete=true;
        foreach ($this->audio as $audio){
            $isComplete = $isComplete && !sizeof($audio->clientAudio) == 0;
        }
        $property = [
            'id' =>  $this ->id,
            'name' =>  $this ->name,
            'description' =>  $this ->description,
            'is_complete'=> $isComplete,
            'price'=> $this->price,
            'payment'=>!sizeof($this->payments) == 0,
            'url_image' =>  asset($this->url_image),
            'url_manual' =>  asset($this->url_manual),
            'url_instructive' =>  $this->affirmations,
            'audios'=> AudioWS::collection($this->audio)
        ];

        return $property;
    }
}
