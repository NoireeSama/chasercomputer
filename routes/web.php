<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::get('/dashboard', function () {
    return redirect()->route('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->name('dashboard.admin');
});

Route::middleware(['auth','role:customer'])->group(function () {
    Route::get('/dashboard/customer', [DashboardController::class, 'customer'])
        ->name('dashboard.customer');
});
