<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KhachHangController;

Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{maSP}', [SanPhamController::class, 'show'])->name('shop.show');
Route::get('/', function () {
    return view('pages.trang-chu');
});

Route::get('/chi-tiet', function () {
    return view('products.chi-tiet');
});


Route::get('/lien-he', function () {
    return view('pages.lien-he');
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
    Route::view('/CKhuyenMai', 'admin.CKhuyenMai.index');
});

Route::get('/gio-hang', function () {
    return view('pages.gio-hang');
});
Route::get('/lich-su-mua-hang', function () {
    return view('pages.lich-su-mua-hang');
});
Route::get('/dang-nhap', function () {
    return view('auth.login');
});
Route::get('/dang-ky', function () {
    return view('auth.register');
});
Route::get('/dang-xuat', function () {
    session()->forget('khachhang');
    return redirect('/');
});
Route::get('/doi-mat-khau', function () {
    return view('auth.doi-mat-khau');
});
Route::get('/thong-tin-ca-nhan', [ProfileController::class, 'index']);
Route::post('/thong-tin-ca-nhan', [ProfileController::class, 'update']);

Route::post('/dang-nhap', [AuthController::class, 'loginKhachHang']);
Route::post('/dang-ky', [AuthController::class, 'registerKhachHang']);
Route::post('/doi-mat-khau', [AuthController::class, 'doiMatKhau']);

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/khach-hang', [KhachHangController::class, 'index'])->name('khachhang.index');
    Route::get('/khach-hang/create', [KhachHangController::class, 'create'])
        ->name('khachhang.create');

    Route::post('/khach-hang/store', [KhachHangController::class, 'store'])
        ->name('khachhang.store');

    Route::post('/khach-hang/destroy/{id}', [KhachHangController::class, 'destroy'])->name('khachhang.destroy');
    Route::post('/khach-hang/restore/{id}', [KhachHangController::class, 'restore'])->name('khachhang.restore');
    Route::get('/khach-hang/edit/{id}', [KhachHangController::class, 'edit'])->name('khachhang.edit');
    Route::put('/khach-hang/update/{id}', [KhachHangController::class, 'update'])
        ->name('khachhang.update');
});
