<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\KonsumenController;

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

Route::get('/konsumen', [KonsumenController::class, 'index'])->name('konsumen.index');
Route::get('/konsumen/create', [KonsumenController::class, 'create'])->name('konsumen.create');
Route::post('/konsumen/store', [KonsumenController::class, 'store'])->name('konsumen.store');
Route::get('/konsumen/{id}/edit', [KonsumenController::class, 'edit'])->name('konsumen.edit');
Route::put('/konsumen/{id}/update', [KonsumenController::class, 'update'])->name('konsumen.update');
Route::delete('/konsumen/{id}/destroy', [KonsumenController::class, 'destroy'])->name('konsumen.destroy');
Route::put('/konsumen/{id}/change-status', [KonsumenController::class, 'changeStatus'])->name('konsumen.changeStatus');

Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
Route::post('/paket/store', [PaketController::class, 'store'])->name('paket.store');
Route::get('/paket/{id}/edit', [PaketController::class, 'edit'])->name('paket.edit');
Route::put('/paket/{id}/update', [PaketController::class, 'update'])->name('paket.update');
Route::delete('/paket/{id}', [PaketController::class, 'destroy'])->name('paket.destroy');
Route::put('/paket/change-status/{id}', [PaketController::class, 'changeStatus'])->name('paket.changeStatus');
Route::get('/paket/filter', [PaketController::class, 'filter'])->name('paket.filter');
