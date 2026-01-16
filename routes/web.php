<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\ThuongHieuController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\SanPhamApiController;
use App\Http\Controllers\DonHangController;

/*
|--------------------------------------------------------------------------
| FRONTEND (KHÁCH HÀNG - KHÔNG CẦN LOGIN)
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| FRONTEND (KHÁCH HÀNG - PHẢI LOGIN)
//begin phat

//end phat

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('pages.trang-chu'));

Route::get('/gioi-thieu', [PageController::class, 'about'])->name('pages.about');

Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{maSP}', [SanPhamController::class, 'show'])->name('shop.show');

// (15) Them vao gio hang
Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('cart.add');
// (17) Thong ke realtime: view/yeu thich/rating


Route::get('/tim-kiem', [SanPhamController::class, 'search'])->name('search');

Route::get('/lien-he', fn() => view('pages.lien-he'));

/*
|--------------------------------------------------------------------------
| AUTH KHÁCH HÀNG
|--------------------------------------------------------------------------
*/
Route::get('/dang-nhap', fn() => view('auth.login'))->name('dang-nhap');
Route::post('/dang-nhap', [AuthController::class, 'loginKhachHang']);
Route::post('/dang-ky', [AuthController::class, 'registerKhachHang']);
Route::get('/dang-ky', fn() => view('auth.register'))->name('dang-ky');
Route::get('/dang-xuat', function () {
    session()->forget('khachhang');
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| FRONTEND (KHÁCH HÀNG - PHẢI LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('khachhang.auth')->group(function () {
    //begin phat
    // (12) Gui danh gia san pham
    Route::post('/san-pham/{maSP}/danh-gia', [SanPhamController::class, 'guiDanhGia'])->name('shop.review');
    //end phat

    Route::get('/gio-hang', fn() => view('pages.gio-hang'));
    Route::get('/lich-su-mua-hang', fn() => view('pages.lich-su-mua-hang'));

    Route::get('/don-hang', [DonHangController::class, 'index'])
        ->name('donhang.index');

    Route::get('/don-hang/{id}', [DonHangController::class, 'show'])
        ->name('donhang.show');

    Route::get('/thong-tin-ca-nhan', [ProfileController::class, 'index']);
    Route::post('/thong-tin-ca-nhan', [ProfileController::class, 'update']);

    Route::get('/doi-mat-khau', fn() => view('auth.doi-mat-khau'));
    Route::post('/doi-mat-khau', [AuthController::class, 'doiMatKhau']);
});


Route::get('/', function () {
    return view('pages.trang-chu');
});

Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{maSP}', [SanPhamController::class, 'show'])->name('shop.show');

Route::get('/lien-he', fn() => view('pages.lien-he'));


Route::get('/dang-xuat', function () {
    session()->forget('khachhang');
    return redirect('/');
});

Route::post('/dang-nhap', [AuthController::class, 'loginKhachHang']);
Route::post('/dang-ky', [AuthController::class, 'registerKhachHang']);
Route::get('/dang-nhap', fn() => view('auth.login'))->name('dang-nhap');
Route::get('/dang-ky', fn() => view('auth.register'))->name('dang-ky');


/*
|--------------------------------------------------------------------------
| ROUTE LOGIN MẶC ĐỊNH (CHO LARAVEL)
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect()->route('admin.login.form');
})->name('login');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH (KHÔNG CẦN LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login.form');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('admin.login');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA (PHẢI LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin')
    ->group(function () {

        Route::get('/', fn() => redirect()->route('admin.dashboard'));

        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        // KHÁCH HÀNG
        Route::get('/khach-hang', [KhachHangController::class, 'index'])
            ->name('khachhang.index');

        Route::get('/khach-hang/create', [KhachHangController::class, 'create'])
            ->name('khachhang.create');

        Route::post('/khach-hang/store', [KhachHangController::class, 'store'])
            ->name('khachhang.store');

        Route::get('/khach-hang/edit/{id}', [KhachHangController::class, 'edit'])
            ->name('khachhang.edit');

        Route::put('/khach-hang/update/{id}', [KhachHangController::class, 'update'])
            ->name('khachhang.update');

        Route::post('/khach-hang/destroy/{id}', [KhachHangController::class, 'destroy'])
            ->name('khachhang.destroy');

        Route::post('/khach-hang/restore/{id}', [KhachHangController::class, 'restore'])
            ->name('khachhang.restore');

        // THƯƠNG HIỆU
        Route::get('/thuong-hieu', [ThuongHieuController::class, 'index'])
            ->name('thuonghieu.index');

        Route::get('/thuong-hieu/create', [ThuongHieuController::class, 'create'])
            ->name('thuonghieu.create');

        Route::post('/thuong-hieu/store', [ThuongHieuController::class, 'store'])
            ->name('thuonghieu.store');

        Route::get('/thuong-hieu/edit/{id}', [ThuongHieuController::class, 'edit'])
            ->name('thuonghieu.edit');

        Route::put('/thuong-hieu/update/{id}', [ThuongHieuController::class, 'update'])
            ->name('thuonghieu.update');

        Route::post('/thuong-hieu/destroy/{id}', [ThuongHieuController::class, 'destroy'])
            ->name('thuonghieu.destroy');

        Route::post('/thuong-hieu/restore/{id}', [ThuongHieuController::class, 'restore'])
            ->name('thuonghieu.restore');

        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
    });
