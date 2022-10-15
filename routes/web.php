<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);

Route::post('logout', [LoginController::class, 'logout']);

// admin controller
Route::get('/dashboard', [AdminController::class, 'home']);

Route::get('/tambah', [AdminController::class, 'tambah']);

Route::get('/detail', [AdminController::class, 'detail']);

Route::get('/edit/{id}', [AdminController::class, 'edit']);

Route::get('/detail-lokasi/{id}', [AdminController::class, 'detail_lokasi']);


//Lokasi controller
Route::get('/', [LokasiController::class, 'index']);

Route::get('/aktif', [LokasiController::class, 'aktif']);

Route::get('/non-aktif', [LokasiController::class, 'non_aktif']);

Route::get('lokasi/json', [LokasiController::class, 'lokasi']);

Route::get('lokasi-aktif/json', [LokasiController::class, 'lokasi_aktif']);

Route::get('lokasi-non/json', [LokasiController::class, 'lokasi_non']);

Route::post('/tambah-lokasi', [LokasiController::class, 'tambah_lokasi']);

Route::post('/edit-lokasi', [LokasiController::class, 'edit_lokasi']);

Route::get('/delete/{id}', [LokasiController::class, 'delete']);

Route::get('/detail/{id}', [LokasiController::class, 'detail_lokasi']);
