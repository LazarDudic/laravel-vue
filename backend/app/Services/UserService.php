<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\ClientErrorException;
use Illuminate\Validation\ValidationException;

class UserService extends AbstractService
{
    protected $repository = UserRepository::class;

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = Role::first()->id; //TODO
        return $this->repository::create($data);
    }

    public function getToken(User $user)
    {
        return $this->repository::getToken($user);
    }

    public function updatePassword($userId, $pasword)
    {
        $user = $this->findByIdOrFail($userId);
        $data['password'] = Hash::make($pasword);
        return $this->repository::update($data, $user);
    }

    public function update($data, $userId)
    {
        $user = $this->findByIdOrFail($userId);
        $userCheck = $this->findByField('email', $data['email']);
        if($userCheck && $userCheck->id != $userId) {
            throw ValidationException::withMessages(['email' => ['Email address is already taken.']]);
        }
        if(empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        return $this->repository::update($data, $user);
    }

    public function delete($id)
    {
        if(auth()->id() == $id) {
            throw new ClientErrorException('You can not delete yourself.');
        }

        $model = $this->findByIdOrFail($id);
        return $this->repository::delete($model);
    }
}
