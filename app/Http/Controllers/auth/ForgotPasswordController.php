<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\auth\forotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function forgot(forotPasswordRequest $request) {

        Password::sendResetLink($request->only('email'));
        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }
    
    public function forgotPassword(){
        return view('auth.reset_password');
    }
}
