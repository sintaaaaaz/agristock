<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\IncomingGoodController;
use App\Http\Controllers\Backend\OutgoingGoodController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SupplierController;
use Illuminate\Support\Facades\Route;

// Rute Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup Rute Autentikasi (Sudah Ditutup dengan Benar)
Route::controller(LoginController::class)->group(function () {
    // Menampilkan form login
    Route::get('/login', 'index')->name('login');
    // Proses login
    Route::post('/login', 'login')->name('login.process');
    // Logout
    Route::post('/logout', 'logout')->name('logout');
}); // <--- Penutup grup controller yang sebelumnya hilang

// Grup Rute Dashboard & Admin (Sudah Ditutup dengan Benar)
Route::middleware('check.login')->group(function () {
    Route::view('/dashboard', 'backend.dashboard.index')->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('incoming-goods', IncomingGoodController::class);
    Route::resource('outgoing-goods', OutgoingGoodController::class);
    Route::resource('reports',  ReportController::class);
    
}); // <--- Penutup grup middleware yang sebelumnya hilang

// Test Bootstrap
Route::view('/test', 'test');
