<?php

namespace App\Http\Resources\Api\Client;

use App\Models\ShoppingCar;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingCartWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $properties =  [
            'id' => $this->id,
            'audio_id' =>isset($this->audio_id)?$this->audio_id:$this->audios_id,
            'phase_id' => $this->phase_id,
            'name' => isset($this->audio)? $this->audio->name: $this->phase->name,
            'description' => isset($this->audio)? $this->audio->description:$this->phase->description,
            'duration' => isset($this->audio)?intval($this->audio->duration) * 1000:count($this->phase->audio),
            'price' => isset($this->audio)?$this->audio->price:$this->phase->price,
            'url_image' => isset($this->audio)?($this->audio->url_image != null ? asset($this->audio->url_image) : null):asset($this->phase->url_image),
            'audio'=>isset($this->audio)?new AudioWS($this->audio):null,
            'phase'=>isset($this->phase)?new PhaseWS($this->phase):null
        ];

        return $properties;
    }
}
