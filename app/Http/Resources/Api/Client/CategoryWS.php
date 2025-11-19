<?php

namespace App\Http\Resources\Api\Client;

use App\Models\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryWS extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Category $this */


        $property = [
            'url_image' => asset($this->url_image),
            'name' => $this->name,
            'description' => $this->description,
            'duration'=> $this->duration,
            'meditations'=> PhaseWS::collection($this->phases),
            'instructive'=> isset($this->url_instructive)? (object)[
                'title' => 'Instrucciones',
                'url' => asset($this->url_instructive),
            ]:null,
            'manual'=> isset($this->url_manual)? (object)[
                'title' => 'Manual',
                'url' => asset($this->url_manual),
            ]:null,
        ];

        return $property;
    }
}
