<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use App\Http\Requests\auth\forotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function forgot(forotPasswordRequest $request) {

        Password::sendResetLink($request->only('email'));
        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }
}
