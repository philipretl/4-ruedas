<?php

namespace App\Actions;

use Venoudev\Results\Exceptions\NotFoundException;

class DeleteModelAction
{
    public static function execute($entity, bool $hard_delete){

        if($hard_delete == false){
            $entity->delete();
            return;
        }
        $entity->forceDelete();
    }
}
