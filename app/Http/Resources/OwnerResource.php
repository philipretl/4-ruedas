<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
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
            'name'=> $this->name,
            'last_name'=> $this->last_name,
            'full_name' => $this->full_name,
            'dni' => $this->dni,
            'user_id' => $this->whenLoaded('user', function (){
                return $this->user->id;
            }),
            'vehicles' =>$this->whenLoaded('vehicles', function(){
                return VehicleResource::collection($this->vehicles);
            }),

        ];
    }
}
