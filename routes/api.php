<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\VerificationController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [LoginController::class, 'login']);

Route::post('register', [RegisterController::class, 'register']);
Route::get('email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');

Route::post('password/email', [ForgotPasswordController::class, 'forgot']);
Route::post('password/reset', [ResetPasswordController::class, 'reset']);
Route::get('forgot_password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.reset');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
    Route::get('users', function () {
        return User::all();
    });
    Route::post('logout', [LoginController::class, 'logout']);
});