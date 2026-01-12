<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\DetailPesananController;
Route::prefix('pesanan')->group(function () {
    Route::post('/', [PesananController::class, 'store']);
    Route::put('{id}', [PesananController::class, 'update']);
    Route::delete('{id}', [PesananController::class, 'destroy']);
});
Route::post('/detail-pesanan', [DetailPesananController::class, 'store']);