<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\OrganismeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentifcation routes


// Users End points
Route::prefix('/users')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{user}', [UserController::class, 'show']);
        // Create a user
        Route::post('/', [UserController::class, 'store']);
        // Update a user
        Route::put('/{user}', [UserController::class, 'update']);
        // Delete a user
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

// Organisations Endpoint
Route::prefix('/organisations')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [OrganismeController::class, 'index']);
        Route::get('/{organisation}', [OrganismeController::class, 'show']);
        // Create an organisation
        Route::post('/', [OrganismeController::class, 'store']);
        // Update an organisation
        Route::put('/{organisation}', [OrganismeController::class, 'update']);
        // Delete an organisation
        Route::delete('/{organisation}', [OrganismeController::class, 'destroy']);
    });

// Projects End points
Route::prefix('projects')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
    });


Route::get('/refresh-database', function () {
    Artisan::call('migrate:fresh --seed');
    return response('Database refreshed and seeded successfully');
});
