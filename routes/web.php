<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminInvoiceController;
use App\Http\Controllers\Admin\AdminFinancialController;

use App\Http\Controllers\FrontEndController;

Route::get('/', [FrontEndController::class, 'index'])->name('home');
Route::get('/tentang-kami', [FrontEndController::class, 'tentangKami'])->name('tentangKami');
Route::get('/katalog-produk', [FrontEndController::class, 'katalogProduk'])->name('katalogProduk');
Route::get('/detail-produk/{id}', [FrontEndController::class, 'detailProduk'])->name('detailProduk');
Route::get('/program-csr', [FrontEndController::class, 'csr'])->name('csr');
Route::get('/kontak', [FrontEndController::class, 'kontak'])->name('kontak');
use App\Http\Controllers\PesananController;
Route::get('/pemesanan', [PesananController::class, 'create'])->name('pemesanan');
Route::post('/pemesanan', [PesananController::class, 'store'])->name('pemesanan.store');
use App\Http\Controllers\Admin\AdminDashboardController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('sidebar', function () {
        return view('admin.sidebar');
    })->name('sidebar');

    Route::resource('produk', AdminProdukController::class)->except(['show']);
    
    Route::get('pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::patch('pesanan/{id}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.updateStatus');
    
    Route::get('invoice', [AdminInvoiceController::class, 'show'])->name('invoice.show');

    // Financial Dashboard
    Route::get('financial', [AdminFinancialController::class, 'index'])->name('financial.index');
    Route::post('financial/year', [AdminFinancialController::class, 'storeYear'])->name('financial.storeYear');
    Route::put('financial/year/{id}', [AdminFinancialController::class, 'updateYear'])->name('financial.updateYear');
    Route::delete('/financial/year/{id}', [AdminFinancialController::class, 'destroyYear'])->name('financial.destroyYear');
    Route::get('/financial/export/{id}', [AdminFinancialController::class, 'exportExcel'])->name('financial.exportExcel');
    Route::patch('financial/monthly/{id}', [AdminFinancialController::class, 'updateMonthly'])->name('financial.updateMonthly');
});
