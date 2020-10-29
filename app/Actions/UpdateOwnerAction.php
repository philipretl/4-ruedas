<?php

namespace App\Actions;

use App\Models\Owner;

class UpdateOwnerAction
{
    /**
     * @param array $data
     * @param $owner
     * @return Owner
     */
    public static function execute(array $data, $owner):Owner{
        $owner->fill([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'dni' => $data['dni']
        ]);
        $owner->save();
        return $owner;
    }
}
