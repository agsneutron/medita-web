<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Audio;
use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;

class AudioWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Audio $this */

        /** @var Client $client */
        $client = \Auth::user();

        $payment= $this->payments()->where('client_id', $client->id)->first();
        $withOutPaymentName= explode(" Track ",$this->name);
        $included=false;
        if ($payment){
            $included=$this->payments[0]->price==0;
        }

        $clientAudio = $this->clientAudio->where('audios_id', $this->id)->first();
        $completed = $clientAudio ? $clientAudio->completed : false;

        $includedIF=$this->is_free == 1;

        $property = [
            'id' => $this->id,
            'name' => $payment?$this->name:$withOutPaymentName[0],
            'description' => $this->description,
            'url_image' => asset($this->url_image),
            'url_audio' =>  asset($this->url_audio),
            'url_download' => isset($this->url_download)? asset($this->url_download):null,
            'url_gif' =>  asset($this->url_gif),
            'duration' =>  intval($this->duration) * 1000,
            'restriction' => $client->teacher == 0 ? $this->restriction_id : 2,
            'payment' => !empty($payment),
            'price' => $this->price,
            'complete' => $client->teacher == 0 ? $completed : true,
            'active' => $this->active,
            'included'=> $includedIF
        ];

        return  $property;
    }
}
