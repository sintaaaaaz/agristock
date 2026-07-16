<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\BackEnd\Auth\RegisterController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\IncomingGoodController;
use App\Http\Controllers\Backend\OutgoingGoodController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;

// Rute Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/user/dashboard', [UserDashboardController::class,'index'])->name('user.dashboard');
Route::get('/user/input-barang',
        [IncomingGoodController::class,'create']
    )->name('user.input');
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('incoming-goods', IncomingGoodController::class);
    Route::resource('outgoing-goods', OutgoingGoodController::class);
    Route::resource('reports',  ReportController::class);

    Route::get('/dashboard/export-pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.pdf');
    Route::get('/dashboard/export-excel', [DashboardController::class, 'exportExcel'])->name('dashboard.excel');

    // Tambahkan ini di bawah rute cetak dashboard barang masuk yang sudah ada
Route::get('/dashboard/export-outgoing-pdf', [DashboardController::class, 'exportOutgoingPdf'])->name('dashboard.outgoing.pdf');
Route::get('/dashboard/export-outgoing-excel', [DashboardController::class, 'exportOutgoingExcel'])->name('dashboard.outgoing.excel');
    
}); // <--- Penutup grup middleware yang sebelumnya hilang

// Test Bootstrap
Route::view('/test', 'test');
