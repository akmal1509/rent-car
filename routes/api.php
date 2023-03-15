<?php

use App\Http\Controllers\Api\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/testing', [CarController::class, 'testMenu']);
Route::get('/cars', [CarController::class, 'index']);
Route::post('/cars', [CarController::class, 'store']);
Route::post('/cars/{id}/edit', [CarController::class, 'update']);
Route::post('/cars/{id}', [CarController::class, 'destroy']);

Route::get('/general', [CarController::class, 'generalGet']);
Route::post('/general', [CarController::class, 'generalPost']);
