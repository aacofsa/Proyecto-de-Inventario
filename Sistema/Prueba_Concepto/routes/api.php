<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BodegaApiController;
use App\Http\Controllers\Api\EmpresaApiController;

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
Route::get('/bodega/{id}/export',  [BodegaApiController::class, 'export']);
// empresa .>
Route::post('/empresa', [EmpresaApiController::class, 'store']);
Route::get('/empresa', [EmpresaApiController::class, 'index']);
Route::get('/empresa/{id}', [EmpresaApiController::class, 'find']);
Route::patch('/empresa/{id}', [EmpresaApiController::class, 'patch']);
