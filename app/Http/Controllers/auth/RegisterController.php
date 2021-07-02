<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\registerUserRequest;

class RegisterController extends Controller
{
    public function register(registerUserRequest $request) {

        $user = User::create(
            $request->only('name', 'email') + [
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
