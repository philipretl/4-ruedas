<?php

namespace App\Actions;

use App\Models\Owner;

class RegisterOwnerAction
{
    public static function execute($data, $user = null):Owner{
        $owner = Owner::make([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'dni' => $data['dni'],
        ]);

        if($user != null){
            $owner->user()->associate($user);
            $owner->load('user');
        }
        $owner->save();
        return $owner;



    }
}
