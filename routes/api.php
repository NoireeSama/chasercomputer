<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PesananController;
use App\Http\Controllers\Api\DetailPesananController;


    Route::delete('{id}', [PesananController::class, 'destroy']);

