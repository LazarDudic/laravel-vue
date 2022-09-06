<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends AbstractRepository
{
    protected static $model = User::class;

    public static function getToken(User $user)
    {
        $token = $user->createToken('auth_token')->accessToken;
        return User::TOKEN_TYPE.' '.$token;
    }
}
