<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends AbstractService
{
    protected $repository = PermissionRepository::class;

    public function create($data)
    {
        return $this->repository::create($data);
    }

    public function update($data, $permissionId)
    {
        $permission = $this->findByIdOrFail($permissionId);
        return $this->repository::update($data, $permission);
    }
}
