<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function __construct(protected UserService $userSev){}

    public function store(RegisterRequest $request)
    {
        $user = $this->userSev->create($request->validated());
        $token = $this->userSev->getToken($user);

        return response()->json([
            'auth_token' => $token,
            'user' => new UserResource($user)
        ]);
    }
}
