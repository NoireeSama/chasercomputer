<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\GaransiController;
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home');
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

Route::middleware(['auth','role:admin'])->group(function () {
    Route::get('/rincianpesanan/{pesanan_id}', [DashboardController::class, 'rincianpesanan'])->name('rincianpesanan');
    Route::post('/rincianpesanan/{pesanan_id}', [DashboardController::class, 'updatePesanan'])->name('pesanan.update');
    Route::get('/product-detail/{produk_id}', [PersediaanController::class, 'detailProduk'])->name('product.detail');
    Route::post('/product-detail/{produk_id}', [PersediaanController::class, 'updateProduk'])->name('produk.update');
    Route::delete('/product-detail/{produk_id}', [PersediaanController::class, 'deleteProduk'])->name('produk.delete');
    Route::get('/tambah-barang', [PersediaanController::class, 'createProduk'])->name('tambah.barang');
    Route::post('/tambah-barang', [PersediaanController::class, 'storeProduk'])->name('produk.store');

    Route::get('/edituser/{user_id}', [DashboardController::class, 'editUser'])->name('edit.user');
    Route::post('/edituser/{user_id}', [DashboardController::class, 'updateUser'])->name('user.update');
    Route::delete('/edituser/{user_id}', [DashboardController::class, 'deleteUser'])->name('user.delete');
    Route::get('/tambahuser', [DashboardController::class, 'createUser'])->name('tambah.user');
    Route::post('/tambahuser', [DashboardController::class, 'storeUser'])->name('user.store');
});

Route::get('/barang/{slug}', [HomeController::class, 'showProduct'])->name('customer.product.show');
Route::post('/barang/{slug}/beli', [HomeController::class, 'buyProduct'])->name('customer.product.buy');
