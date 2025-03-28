<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiBarangController;
use App\Http\Controllers\Api\ApiPelangganController;
use App\Http\Controllers\Api\ApiPenjualanController;

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

Route::get('/barangs', [ApiBarangController::class, 'index']);
Route::post('/barangs', [ApiBarangController::class, 'store']);
Route::get('/barangs/{id}', [ApiBarangController::class, 'show']);
Route::put('/barangs/{id}', [ApiBarangController::class, 'update']);
Route::delete('/barangs/{id}', [ApiBarangController::class, 'destroy']);

Route::get('/penjualans', [ApiPenjualanController::class, 'index']);
Route::post('/penjualans', [ApiPenjualanController::class, 'store']);
Route::get('/penjualans/{id}', [ApiPenjualanController::class, 'show']);
Route::put('/penjualans/{id}', [ApiPenjualanController::class, 'update']);
Route::delete('/penjualans/{id}', [ApiPenjualanController::class, 'delete']);
