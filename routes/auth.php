<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;




Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
