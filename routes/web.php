<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\NilaiController;
use App\Models\Kelas;

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

Route::get('/kelas', [KelasController::class, "index"]);
Route::post('/kelas/add', [KelasController::class, "store"]);
Route::get('/kelas/{id}', [KelasController::class, "show"]);
Route::put('/kelas/{id}', [KelasController::class, "update"]);
Route::delete('kelas/{id}', [KelasController::class, "destroy"]);

Route::get('/csrf', function () {
    return csrf_token();
});

Route::get('/siswa', [SiswaController::class, "index"]);
Route::post('/siswa', [SiswaController::class, "store"]);
Route::get('/siswa/{nim}', [SiswaController::class, "show"]);

Route::post('/matakuliah', [MatakuliahController::class, "store"]);
Route::get('/matakuliah', [MatakuliahController::class, "index"]);

Route::post('/nilai', [NilaiController::class, "store"]);
