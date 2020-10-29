<?php

namespace App\Actions;

use App\Models\Owner;
use Venoudev\Results\Exceptions\NotFoundException;

class FindOwnerAction
{
    /**
     * @param $owner_id
     * @return Owner
     * @throws NotFoundException
     */
    public static function execute($owner_id):Owner{
        $owner = Owner::find($owner_id);

        if($owner == null){
            throw new NotFoundException();
        }
        $owner->load(['user', 'vehicles']);
        return $owner;
    }
}
