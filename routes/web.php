<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AparController;
use App\Http\Controllers\InspeksiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rute Publik (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// Otentikasi Laravel UI (Login, Register, Logout)
Auth::routes();

// Grup Rute yang membutuhkan otentikasi (semua pengguna yang sudah login)
Route::middleware(['auth'])->group(function () {

    // Rute Admin (hanya untuk role 'admin')
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // --- Perbaikan: Menggunakan Route::resource untuk Manajemen Pengguna ---
        Route::resource('users', AdminController::class)->except(['show']);
        
        // Rute untuk Manajemen APAR (CRUD)
        Route::resource('apars', AparController::class); 
        
        // Rute untuk Laporan Inspeksi (juga hanya untuk admin)
        Route::get('/reports/inspeksi/export', [AdminController::class, 'exportInspeksi'])->name('reports.inspeksi.export');
    });

    // Rute SO (hanya untuk role 'so')
    Route::prefix('inspeksi')->name('inspeksi.')->middleware('so')->group(function () {
        Route::get('/scan', [InspeksiController::class, 'scan'])->name('scan');
        Route::get('/{apar}', [InspeksiController::class, 'showAparDetail'])->name('show');
        Route::post('/', [InspeksiController::class, 'store'])->name('store');
    });

    // Rute Pengalihan Dashboard Umum setelah Login
    // Pengguna akan diarahkan ke sini setelah login, lalu dialihkan lagi berdasarkan peran
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::user()->role === 'so') {
            return redirect()->route('inspeksi.scan');
        }
        // Fallback jika role tidak terdefinisi atau tidak sesuai
        return redirect('/');
    })->name('dashboard');
});
