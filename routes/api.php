<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPelangganController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pelanggans', [ApiPelangganController::class, 'index']);
Route::post('/pelanggans', [ApiPelangganController::class, 'store']);
Route::get('/pelanggans/{id}', [ApiPelangganController::class, 'show']);
Route::put('/pelanggans/{id}', [ApiPelangganController::class, 'update']);
Route::delete('/pelanggans/{id}', [ApiPelangganController::class, 'destroy']);
