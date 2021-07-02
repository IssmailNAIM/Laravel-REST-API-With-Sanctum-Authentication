<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\auth\loginUserRequest;

class LoginController extends Controller
{
    public function login(loginUserRequest $request) {
        
        $user = User::where('email', $request->email)->first();

        // Check password
        if(!Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'bad credits'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout() {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out',
            'user logout' => auth()->user()
        ];
    }
}
