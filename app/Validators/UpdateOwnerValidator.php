<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Venoudev\Results\Exceptions\CheckDataException;

class UpdateOwnerValidator
{
    /**
     * @param array $data
     * @param $owner
     * @throws CheckDataException
     */
    public static function execute(array $data, $owner){

        $validator = Validator::make($data, [
            'name' => ['bail', 'required'],
            'last_name' => ['bail', 'required'],
            'dni' => ['bail', 'required', 'numeric', Rule::unique('owners')->ignore($owner->dni)],
        ]);

        if ($validator->fails()) {
            $exception = new CheckDataException();
            $exception->addFieldErrors($validator->errors());
            throw $exception;
        }
    }
}
