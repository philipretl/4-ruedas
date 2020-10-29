<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Venoudev\Results\Exceptions\CheckDataException;

class RegisterVehicleValidator
{
    public static function execute($data){

        $validator = Validator::make($data, [
            'vehicle_plate' => ['bail', 'required', 'string', 'unique:vehicles,vehicle_plate'],
            'model' => ['bail', 'required', 'string'],
            'brand' => ['bail', 'required', 'string'],
            'type' => ['bail', 'required', Rule::in(['motorcycle', 'car', 'truck']),],
            'owner_id' => ['bail', 'required', 'exists:owners,id', 'numeric']
        ]);

        if ($validator->fails()) {
            $exception = new CheckDataException();
            $exception->addFieldErrors($validator->errors());
            throw $exception;
        }
    }
}
