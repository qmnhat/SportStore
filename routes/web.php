<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.trang-chu');
});
Route::get('/san-pham', function () {
    return view('products.san-pham');
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
Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard');

    Route::view('/CSanPham', 'admin.CSanPham.index');
    Route::view('/CDanhMuc', 'admin.CDanhMuc.index');
    Route::view('/CThuongHieu', 'admin.CThuongHieu.index');
    Route::view('/CDonHang', 'admin.CDonHang.index');
    Route::view('/CKhachHang', 'admin.CKhachHang.index');
    Route::view('/CKhuyenMai', 'admin.CKhuyenMai.index');
});