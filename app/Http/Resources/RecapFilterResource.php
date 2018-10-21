<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecapFilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'position' => $this->position,
            'location' => $this->location,
            'formation' => $this->formation,
            'registrar' => $this->registrar,
            'pass' => $this->pass,
            'fail' => $this->fail,
        ];
    }
}
