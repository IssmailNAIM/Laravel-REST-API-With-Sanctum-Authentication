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

        // if($user->email_verified_at == null) {
        //     $user->sendEmailVerificationNotification();
        //     return response([
        //         'message' => 'Email verification link sent to your email.'
        //     ], 401);

        // } elseif(!Hash::check($request->password, $user->password)) { // Check password
        //     return response([
        //         'message' => 'bad credits'
        //     ], 401);
        // }

        $token = $user->createToken('token')->plainTextToken;

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
