<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Exceptions\ClientErrorException;

class RoleService extends AbstractService
{
    protected $repository = RoleRepository::class;

    public function create($data)
    {
        return $this->repository::create($data);
    }

    public function update($data, $roleId)
    {
        $role = $this->findByIdOrFail($roleId);
        return $this->repository::update($data, $role);
    }

    public function delete($roleId)
    {
        if((new UserService())->findByField('role_id', $roleId)) {
            throw new ClientErrorException('You can not delete role. There are Useres attached to this role.');
        }

        $model = $this->findByIdOrFail($roleId);
        return $this->repository::delete($model);
    }
}
