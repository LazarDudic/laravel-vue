<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Exceptions\ClientErrorException;

class RoleService extends AbstractService
{
    protected $repository = RoleRepository::class;

    public function create($data)
    {
        $role = $this->repository::create($data);
        if(!empty($data['permissions'])) {
            $role->permissions()->attach($data['permissions']);
        }
        return $role;
    }

    public function update($data, $roleId)
    {
        $role = $this->findByIdOrFail($roleId);
        $role = $this->repository::update($data, $role);
        if(!empty($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        } else {
            $role->permissions()->detach();
        }
        return $role;
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
