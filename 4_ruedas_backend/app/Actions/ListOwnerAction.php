<?php

namespace App\Actions;
use App\Models\Owner;

class ListOwnerAction
{
    public static function execute(){
        $pagination = config('4ruedas.pagination');
        return Owner::paginate($pagination);
    }
}
