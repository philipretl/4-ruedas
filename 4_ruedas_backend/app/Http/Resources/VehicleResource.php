<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'brand' => $this->brand,
            'model' => $this->model,
            'vehicle_plate' => $this->vehicle_plate,
            'type' => $this->type,
        ];
    }
}
