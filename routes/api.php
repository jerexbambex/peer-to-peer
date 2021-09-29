<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function(){
    Route::post('/login', [LoginController::class, 'login']);

    //Facebook, Google, Twitter Login
    Route::post('/social-login', [LoginController::class, 'loginWithSocialMedia']);

    //Forgot password
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);

    //Register
    Route::post('/register', [RegisterController::class, 'store']);
});

