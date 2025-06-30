<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';

Route::inertia('/', 'Home')->name('home');




