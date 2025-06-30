<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login' , [AuthController::class , 'create'])->name('login');
    Route::post('/login' , [AuthController::class , 'store']);



});

Route::middleware('auth')->group(function(){
    Route::post('/logout' , [AuthController::class , 'destroy'])->name('logout');

});

