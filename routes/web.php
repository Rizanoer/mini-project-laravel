<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Pelanggan
Route::get('/pelanggans', [PelangganController::class, 'index'])->name('pelanggans.index');
Route::get('/pelanggans/create', [PelangganController::class, 'create'])->name('pelanggans.create');
Route::post('/pelanggans/store', [PelangganController::class, 'store'])->name('pelanggans.store');
Route::get('/pelanggans/edit/{id}', [PelangganController::class, 'edit'])->name('pelanggans.edit');
Route::put('/pelanggans/update/{id}', [PelangganController::class, 'update'])->name('pelanggans.update');
Route::delete('/pelanggans/delete/{id}', [PelangganController::class, 'delete'])->name('pelanggans.delete');

// Barang
Route::get('/barangs', [BarangController::class, 'index'])->name('barangs.index');
Route::get('/barangs/create', [BarangController::class, 'create'])->name('barangs.create');
Route::post('/barangs/store', [BarangController::class, 'store'])->name('barangs.store');
Route::get('/barangs/edit/{id}', [BarangController::class, 'edit'])->name('barangs.edit');
Route::put('/barangs/update{id}', [BarangController::class, 'update'])->name('barangs.update');
Route::delete('/barangs/delete/{id}', [BarangController::class, 'delete'])->name('barangs.delete');

// Penjualan
Route::get('/penjualans', [PenjualanController::class, 'index'])->name('penjualans.index');
Route::get('/penjualans/create', [PenjualanController::class, 'create'])->name('penjualans.create');
Route::post('/penjualans/store', [PenjualanController::class, 'store'])->name('penjualans.store');
Route::get('/penjualans/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualans.edit');
Route::put('/penjualans/update{id}', [PenjualanController::class, 'update'])->name('penjualans.update');
Route::delete('/penjualans/delete/{id}', [PenjualanController::class, 'delete'])->name('penjualans.delete');
