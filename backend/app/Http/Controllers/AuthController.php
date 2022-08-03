<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Lcobucci\JWT\Token\Parser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $tokenType = 'Bearer';

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'string', 'min:6'],
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 400);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'auth_token' => $this->tokenType.' '.$token,
            'user' => $user
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'auth_token' => $this->tokenType.' '.$token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json(['success' => 'success'], 200);
    }
}
