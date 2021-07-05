<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response(["message" => "Invalid/Expired url provided."], 401);
        }
      
        $user = User::findOrFail($user_id);
        return $user->hasVerifiedEmail() ? $user->markEmailAsVerified(): redirect()->to('/');
    }
}
