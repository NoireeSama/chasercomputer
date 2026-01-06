<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PesananController;

Route::prefix('pesanan')->group(function () {
    Route::put('{id}', [PesananController::class, 'update']);
    Route::delete('{id}', [PesananController::class, 'destroy']);
});
