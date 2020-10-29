<?php

namespace App\Services\Contracts;
use App\Models\Vehicle;

interface VehiclesService {
    public function listVehicle();
    public function registerVehicle(array $data):Vehicle;
    public function findVehicle(int $Vehicle_id):Vehicle;
    public function updateVehicle(array $data, int $Vehicle_id):Vehicle;
    public function deleteVehicle(int $Vehicle_id, bool $hard_delete);

}
