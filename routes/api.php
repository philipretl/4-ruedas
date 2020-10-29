<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OwnerController;
use App\Http\Controllers\Api\VehicleController;

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

Route::group(['prefix' => 'v1'], function () {

    Route::prefix('owner')
        ->group(function () {
            Route::post('/register', [OwnerController::class, 'store']);
            Route::put('/update/{owner_id}', [OwnerController::class, 'update']);
            Route::get('/find/{owner_id}', [OwnerController::class, 'show']);
            Route::get('/list', [OwnerController::class, 'index']);
            Route::delete('/delete/{owner_id}', [OwnerController::class, 'destroy']);
    });

    Route::prefix('vehicle')
        ->group(function () {
            Route::post('/register', [VehicleController::class, 'store']);
        });
});
