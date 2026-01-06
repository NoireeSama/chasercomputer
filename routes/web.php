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

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/daftar', [AuthController::class, 'daftar'])->name('daftar');

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('dashboard.admin');
});

Route::middleware(['auth','role:customer'])->group(function () {
    Route::get('/dashboard/customer', [DashboardController::class, 'customer'])
        ->name('dashboard.customer');
});

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/staff', [DashboardController::class, 'staff'])
        ->name('staff');

    Route::post('/staff', [DashboardController::class, 'tambahStaff'])
        ->name('staff.tambah');
});

Route::get('/dashboard', function () {return redirect()->route('dashboard.admin');});
Route::get('/persediaan', fn () => view('admin.persediaan'))->name('persediaan');
Route::get('/garansi', fn () => view('admin.garansi'))->name('garansi');
Route::get('/cabang', fn () => view('admin.cabang'))->name('cabang');
Route::get('/rakitan', fn () => view('admin.rakitan'))->name('rakitan');
