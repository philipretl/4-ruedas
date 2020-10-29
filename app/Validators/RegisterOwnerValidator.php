<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Venoudev\Results\Exceptions\CheckDataException;

class RegisterOwnerValidator
{
    /**
     * @param $data
     * @throws CheckDataException
     */
    public static function execute($data){

        $validator = Validator::make($data, [
            'name' => ['bail', 'required'],
            'last_name' => ['bail', 'required'],
            'dni' => ['bail', 'required', 'unique:owners,dni', 'numeric'],
        ]);

        if ($validator->fails()) {
            $exception = new CheckDataException();
            $exception->addFieldErrors($validator->errors());
            throw $exception;
        }
    }
}
