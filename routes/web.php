<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\Admin\AdminFinancialController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\ShadowAuthController;
use App\Http\Controllers\Admin\AdminArmadaController;

use App\Http\Controllers\FrontEndController;

Route::get('/', [FrontEndController::class, 'index'])->name('home');
Route::get('/tentang-kami', [FrontEndController::class, 'tentangKami'])->name('tentangKami');
Route::get('/katalog-produk', [FrontEndController::class, 'katalogProduk'])->name('katalogProduk');
Route::get('/detail-produk/{id}', [FrontEndController::class, 'detailProduk'])->name('detailProduk');
Route::get('/program-csr', [FrontEndController::class, 'csr'])->name('csr');
Route::get('/kontak', [FrontEndController::class, 'kontak'])->name('kontak');

// Shadow Login
Route::middleware('guest')->group(function () {
    Route::get('/shadow', [ShadowAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/shadow', [ShadowAuthController::class, 'login']);
});
Route::post('/logout', [ShadowAuthController::class, 'logout'])->name('logout')->middleware('auth');

use App\Http\Controllers\PesananController;
Route::get('/pemesanan', [PesananController::class, 'create'])->name('pemesanan');
Route::post('/pemesanan', [PesananController::class, 'store'])->name('pemesanan.store');
use App\Http\Controllers\Admin\AdminDashboardController;

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('sidebar', function () {
        return view('admin.sidebar');
    })->name('sidebar');

    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':super admin'])->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
        Route::resource('produk', AdminProdukController::class)->except(['show']);
        
        Route::get('pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
        Route::patch('pesanan/{id}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
        
        Route::get('invoice', [AdminInvoiceController::class, 'show'])->name('invoice.show');

        // User Management
        Route::resource('users', AdminUserController::class)->except(['show']);

        // Armada Management
        Route::resource('armada', AdminArmadaController::class)->except(['show']);
    });

    // Financial Dashboard (Accessible by admin and super admin)
    Route::middleware([\App\Http\Middleware\RoleMiddleware::class.':admin'])->group(function () {
    Route::get('financial', [AdminFinancialController::class, 'index'])->name('financial.index');
    Route::post('financial/year', [AdminFinancialController::class, 'storeYear'])->name('financial.storeYear');
    Route::put('financial/year/{id}', [AdminFinancialController::class, 'updateYear'])->name('financial.updateYear');
    Route::delete('/financial/year/{id}', [AdminFinancialController::class, 'destroyYear'])->name('financial.destroyYear');
    Route::get('/financial/export/{id}', [AdminFinancialController::class, 'exportExcel'])->name('financial.exportExcel');
    Route::patch('financial/monthly/{id}', [AdminFinancialController::class, 'updateMonthly'])->name('financial.updateMonthly');

    });
});
