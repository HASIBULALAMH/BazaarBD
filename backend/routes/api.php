<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
//register route
Route::post('/register', RegisterController::class);

//Login route
Route::post('/Login',[LoginController::class,'login']);
