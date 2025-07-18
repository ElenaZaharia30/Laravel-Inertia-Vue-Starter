<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\EmailVarificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::middleware('guest')->group(function(){

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login' , [AuthController::class , 'create'])->name('login');
    Route::post('/login' , [AuthController::class , 'store']);

    //password reset
    Route::get('/forgot-password', [ResetPasswordController::class, 'requestPass'] )->name('password.request');

    Route::post('/forgot-password', [ResetPasswordController::class , 'sendEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetForm'])->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'resetHandler'] )->name('password.update');
});



Route::middleware('auth')->group(function(){
    Route::post('/logout' , [AuthController::class , 'destroy'])->name('logout');

    // email varification
    Route::get('/email/verify',
        [EmailVarificationController::class, 'notice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}',
        [EmailVarificationController::class, 'handler'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification',
        [EmailVarificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // confirm pass

    Route::get('/confirm-password',
        [ConfirmPasswordController::class, 'create'])
        ->name('password.confirm');

    Route::post('/confirm-password',
        [ConfirmPasswordController::class, 'store' ])
        ->middleware('throttle:6,1');

});

