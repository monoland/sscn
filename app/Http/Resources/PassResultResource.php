<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassResultResource extends JsonResource
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
            'id' => $this->id,
            'nik' => $this->nik,
            'nama' => $this->name,
            'lokasi' => $this->location_name,
            'posisi' => $this->position_name,
            'nomor' => $this->participant_numb,
            'status' => 'Lulus Verifikasi'
        ];
    }
}
