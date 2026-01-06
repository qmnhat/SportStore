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
