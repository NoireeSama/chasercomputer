<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\DetailPesananController;

Route::prefix('pesanan')->gr
Route::post('/detail-pesanan', [DetailPesananController::class, 'store']);
oup(function () {
    Route::post('/', [PesananController::class, 'store']);
    Route::put('{id}', [PesananController::class, 'update']);
    Route::delete('{id}', [PesananController::class, 'destroy']);
});
