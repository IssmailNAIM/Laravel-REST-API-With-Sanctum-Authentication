<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\auth\ResetPasswordController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('password/email', [ForgotPasswordController::class, 'forgot']);
Route::post('password/reset',  [ResetPasswordController::class, 'reset']);

Route::view('forgot_password', 'auth.reset_password')->name('password.reset');

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('users', function () {
        return User::all();
    });
    Route::post('logout', [LoginController::class, 'logout']);
});