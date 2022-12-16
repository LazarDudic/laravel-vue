<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    public function __construct(protected UserService $userSev){}

    public function store(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login credentials.'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->userSev->findByField('email', $request->email);
        $token = $this->userSev->getToken($user);

        return response()->json([
            'auth_token' => $token,
            'user' => new UserResource($user)
        ], 201);
    }

    public function destroy()
    {
        if(Auth::check()) {
            Auth::user()->token()->revoke();
        }
        return response()->json([], Response::HTTP_OK);
    }

}
