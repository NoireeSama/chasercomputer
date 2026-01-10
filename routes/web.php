<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\GaransiController;
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
    Route::get('/persediaan', [PersediaanController::class, 'index'])->name('persediaan');
    Route::get('/garansi', [GaransiController::class, 'index'])->name('garansi');
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
Route::get('/rincianpesanan', function () {
    return view('admin.branch.rincianpesanan');
})->name('rincianpesanan');
Route::get('/product-detail', function () {
    return view('admin.branch.detailbarang');
})->name('product.detail');

Route::get('/tambah-barang', function () {
    return view('admin.branch.tambahbarang');
})->name('tambah.barang');

Route::get('/edituser', function () {
    return view('admin.branch.edituser');
})->name('edit.user');
Route::get('/tambahuser', function () {
    return view('admin.branch.tambahuser');
})->name('tambah.user');
