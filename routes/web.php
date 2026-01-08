<?php

use Illuminate\Support\Facades\Route;
// routes/web.php
use App\Http\Controllers\SanPhamController;

Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{maSP}', [SanPhamController::class, 'show'])->name('shop.show');
Route::get('/', function () {
    return view('pages.trang-chu');
});

Route::get('/chi-tiet', function () {
    return view('products.chi-tiet');
});
Route::get('/thong-tin-ca-nhan', function () {
    return view('pages.profile');
});
Route::get('/don-hang', function () {
    return view('pages.don-hang');
});
Route::get('/don-hang/{id}', function ($id) {
    return view('pages.chi-tiet-don-hang');
});
Route::get('/gio-hang', function () {
    return view('pages.gio-hang');
});
Route::get('/lich-su-mua-hang', function () {
    return view('pages.lich-su-mua-hang');
});
Route::view('/dang-nhap', 'auth.login');
Route::view('/dang-ky', 'auth.register');
Route::view('/doi-mat-khau', 'auth.change-password');
