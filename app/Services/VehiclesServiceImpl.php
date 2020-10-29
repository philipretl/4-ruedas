<?php

namespace App\Services;

use App\Actions\FindOwnerAction;
use App\Actions\RegisterVehicleAction;
use App\Models\Vehicle;
use App\Services\Contracts\VehiclesService;
use App\Validators\RegisterVehicleValidator;
use Illuminate\Http\Request;

class VehiclesServiceImpl implements VehiclesService{


    public function listVehicle()
    {
        // TODO: Implement listVehicle() method.
    }

    public function registerVehicle(array $data): Vehicle
    {
        RegisterVehicleValidator::execute($data);
        $owner = FindOwnerAction::execute($data['owner_id']);
        return RegisterVehicleAction::execute($data, $owner);
    }

    public function findVehicle(int $Vehicle_id): Vehicle
    {
        // TODO: Implement findVehicle() method.
    }

    public function updateVehicle(array $data, int $Vehicle_id): Vehicle
    {
        // TODO: Implement updateVehicle() method.
    }

    public function deleteVehicle(int $Vehicle_id, bool $hard_delete)
    {
        // TODO: Implement deleteVehicle() method.
    }
}
