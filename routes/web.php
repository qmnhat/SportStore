<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Trang chủ
Route::get('/', function () {
    return view('pages.trang-chu');
});

// Sản phẩm
Route::get('/san-pham', function () {
    return view('products.san-pham');
});
Route::get('/chi-tiet', function () {
    return view('products.chi-tiet');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/dang-nhap', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('/dang-nhap', [AuthController::class, 'handleLogin']);

    Route::get('/dang-ky', [AuthController::class, 'showRegister'])->name('auth.register');
    Route::post('/dang-ky', [AuthController::class, 'handleRegister']);
});

// Protected Routes (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/thong-tin-ca-nhan', function () {
        return view('pages.profile');
    });
    Route::get('/don-hang', function () {
        return view('pages.don-hang');
    });
    Route::get('/don-hang/{id}', function ($id) {
        return view('pages.chi-tiet-don-hang');
    });

    Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('auth.logout');
});
