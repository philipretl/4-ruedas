<?php

namespace App\Services\Contracts;

use App\Models\Owner;

interface OwnerService {

    public function listOwner();
    public function registerOwner(array $data):Owner;
    public function findOwner(int $owner_id):Owner;
    public function updateOwner(array $data, int $owner_id):Owner;
    public function deleteOwner(int $owner_id, bool $hard_delete);
}
