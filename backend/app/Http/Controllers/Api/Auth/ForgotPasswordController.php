<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\ClientErrorException;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function store(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink($request->only('email'));
        $this->validateStatus($status);

        return response()->json(['success' => 'Reset link has been sent to your email.'], 200);
    }

    public function validateStatus($status)
    {
        match ($status) {
            Password::RESET_LINK_SENT => true,
            Password::INVALID_USER => throw new ClientErrorException('User is not valid.'),
            Password::RESET_THROTTLED => throw new ClientErrorException('Too Many Attempts. Check your email if empty try again later.'),
            default => throw new ClientErrorException('Reset link has not been sent. Please try again or contact administrator.'),
        };
    }
}
