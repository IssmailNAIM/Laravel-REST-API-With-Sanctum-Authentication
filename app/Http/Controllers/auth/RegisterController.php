<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\registerUserRequest;

class RegisterController extends Controller
{
    public function register(registerUserRequest $request) {

        $user = User::create($request->only('name', 'email')+ [
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $user->sendEmailVerificationNotification();
        
        $response = [
            'user' => $user,
            'token' => $token,
            'message' => 'Email verification link sent to your email.'
        ];

        return response($response, 201);
    }
}
