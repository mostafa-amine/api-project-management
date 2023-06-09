<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Api\ProjectController;
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

// Users End points
Route::prefix('/users')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

// Organisations Endpoint
Route::prefix('/organisations')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [OrganismeController::class, 'index']);
        Route::get('/{organisation}', [OrganismeController::class, 'show']);
        Route::post('/', [OrganismeController::class, 'store']);
        Route::put('/{organisation}', [OrganismeController::class, 'update']);
        Route::delete('/{organisation}', [OrganismeController::class, 'destroy']);
    });

// Projects End points
Route::prefix('projects')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/{id}', [ProjectController::class, 'show']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::put('/{id}', [ProjectController::class, 'update']);
        Route::delete('/{id}', [ProjectController::class, 'destroy']);
        // Phases
        Route::get('/{id}/phases', [ProjectController::class, 'showPhases']);
        Route::get('/{id}/{phase:code}', [ProjectController::class, 'showPhase']);
    });


Route::get('/refresh-database', function () {
    Artisan::call('migrate:fresh --seed');
    return response('Database refreshed and seeded successfully');
});
