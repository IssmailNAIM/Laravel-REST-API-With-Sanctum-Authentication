<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\auth\resetPasswordRequest;

class ResetPasswordController extends Controller
{
    public function reset(resetPasswordRequest $request) {

        $reset_password = Password::reset($request->validated(), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($reset_password == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return response()->json(["msg" => "Password has been successfully changed"]);
    }
}
