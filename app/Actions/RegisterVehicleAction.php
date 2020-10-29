<?php

namespace App\Actions;

use App\Models\Vehicle;

class RegisterVehicleAction
{
    public static function execute($data, $owner):Vehicle{
        $vehicle = Vehicle::make([
            'vehicle_plate' => $data['vehicle_plate'],
            'brand' => $data['brand'],
            'model' => $data['model'],
            'type' => $data['type'],
        ]);

        $vehicle->owner()->associate($owner);
        $vehicle->save();
        return $vehicle;

    }
}
