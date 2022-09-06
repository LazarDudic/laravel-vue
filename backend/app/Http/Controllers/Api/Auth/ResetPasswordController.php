<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Exceptions\ClientErrorException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function store(ResetPasswordRequest $request)
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                (new UserService())->updatePassword($user->id, $request->password);
                // event(new PasswordReset($user));
            }
        );

        $this->validateStatus($status);

        return response()->json(['success' => 'Password has been reset successfully.'], 200);
    }

    public function validateStatus($status)
    {
        match ($status) {
            Password::PASSWORD_RESET => true,
            Password::INVALID_TOKEN => throw new ClientErrorException('Your reset password token is not valid.'),
            default => throw new ClientErrorException('Something went wrong. Try again or contact adminstrrastor.'),
        };
    }
}
