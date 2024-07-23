<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BuatLaporanController;
use App\Http\Controllers\InsidenController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\SanctumMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('list-user', [AuthController::class, 'listuser']);

Route::get('get-data-form-insiden', [InsidenController::class, 'index']);

Route::middleware([SanctumMiddleware::class])->group(function () {
    Route::get('list-kejadian', [BuatLaporanController::class, 'index']);
    Route::get('data-insiden-terkirim', [BuatLaporanController::class, 'getDataInsidenTerkirim']);
    Route::get('insiden/{id}', [BuatLaporanController::class, 'getDetail']);
    Route::post('kejadian/create', [BuatLaporanController::class, 'store']);
    Route::get('list-insiden-atasan', [BuatLaporanController::class, 'listInsidenUntukAtasan']); //internal
    Route::get('list-insiden-eksternal', [InsidenController::class, 'listInsidenEksternal']);

    Route::post('create-laporan-penerima-insident', [InsidenController::class, 'createPenerimaLaporanInsident']);
    Route::post('set-grading-resiko/{id}', [BuatLaporanController::class, 'setGradingReskio']);

    Route::get('jamlihat/{id}', [InsidenController::class, 'jamlihat']);
    Route::get('jamlihat-eksternal/{id}', [InsidenController::class, 'jamlihateksternal']);
    Route::get('list-penerima-laporan-insident/{id}', [InsidenController::class, 'listPenerimaLaporanInsiden']);

    Route::get('support-row', [SupportController::class, 'index']);

    Route::get('list-penerima-laporan-all/{id}', [InsidenController::class, 'listpenerimaall']);
    Route::delete('delete-penerima/{id}', [InsidenController::class, 'deletepenerima']);
});
//setGradingReskio

Route::get('pasien', [AuthController::class, 'pasien']);

Route::get('list-atasan', [InsidenController::class, 'listAtasan']);

// user
Route::get('list-user', [UserController::class, 'index']);
Route::get('users/detail', [UserController::class, 'detail']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::post('user/create', [UserController::class, 'store']);
Route::post('user/change-password', [UserController::class, 'ubahPassword']);
Route::post('user/{id}/update', [UserController::class, 'update']);
Route::get('jabatan-unit', [UserController::class, 'jabatanDanUnit']);
Route::delete('delete-user/{id}', [UserController::class, 'destroy']);

// jabatan
Route::get('list-jabatan', [JabatanController::class, 'index']);
Route::get('jabatan/{id}', [JabatanController::class, 'show']);
Route::post('jabatan/create', [JabatanController::class, 'store']);
Route::post('jabatan/{id}/update', [JabatanController::class, 'update']);
Route::delete('delete-jabatan/{id}', [JabatanController::class, 'destroy']);


// unit
Route::get('list-unit', [UnitController::class, 'index']);
Route::get('data-dropdwon-user', [UnitController::class, 'dropdwondata']);
Route::get('list-unit/{id}', [UnitController::class, 'show']);
Route::post('list-unit/create', [UnitController::class, 'store']);
Route::post('list-unit/{id}/update', [UnitController::class, 'update']);
Route::delete('list-unit/{id}/delete', [UnitController::class, 'destroy']);

Route::get('cek-login', [AuthController::class, 'cekLogin']);

