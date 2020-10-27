<?php

namespace App\Services;

use App\Actions\DeleteModelAction;
use App\Actions\FindOwnerAction;
use App\Actions\ListOwnerAction;
use App\Actions\RegisterOwnerAction;
use App\Actions\UpdateOwnerAction;
use App\Models\Owner;
use App\Services\Contracts\OwnerService;
use App\Validators\RegisterOwnerValidator;
use App\Validators\UpdateOwnerValidator;

class OwnerServiceImpl implements OwnerService{


    public function listOwner()
    {
        return ListOwnerAction::execute();
    }

    public function registerOwner(array $data): Owner
    {
        RegisterOwnerValidator::execute($data);
        return RegisterOwnerAction::execute($data);

    }

    public function updateOwner(array $data, int $owner_id):Owner
    {
        $owner = FindOwnerAction::execute($owner_id);
        UpdateOwnerValidator::execute($data, $owner);
        return UpdateOwnerAction::execute($data, $owner);
    }

    public function deleteOwner(int $owner_id, bool $hard_delete = false)
    {
        $owner = FindOwnerAction::execute($owner_id);
        DeleteModelAction::execute($owner, $hard_delete);
    }

    public function findOwner(int $owner_id): Owner
    {
        return FindOwnerAction::execute($owner_id);
    }
}
