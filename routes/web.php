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
use App\Http\Controllers\Admin\KhuyenMaiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminCompanyInfoController;
use Faker\Provider\Company;

//route liên hệ(nghia)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/', [PageController::class, 'home'])->name('home');

//end phat

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIC)
|--------------------------------------------------------------------------
*/



Route::get('/gioi-thieu', [PageController::class, 'about'])->name('pages.about');

Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{maSP}', [SanPhamController::class, 'show'])->name('shop.show');

// (15) Them vao gio hang
Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('cart.add');
// (17) Thong ke realtime: view/yeu thich/rating

Route::get('/san-pham/{maSP}/thong-ke', [SanPhamApiController::class, 'thongKe']);
Route::post('/san-pham/{maSP}/yeu-thich', [SanPhamApiController::class, 'yeuThich']);


Route::get('/tim-kiem', [SanPhamController::class, 'search'])->name('search');

Route::get('/lien-he', fn() => view('pages.lien-he'));

/*
|--------------------------------------------------------------------------
| AUTH KHÁCH HÀNG
|--------------------------------------------------------------------------
*/
Route::get('/dang-nhap', fn() => view('auth.login'))->name('dang-nhap');
Route::post('/dang-nhap', [AuthController::class, 'loginKhachHang']);
Route::post('/gio-hang/cap-nhat', [GioHangController::class, 'capNhat'])->name('cart.update');
Route::post('/gio-hang/xoa', [GioHangController::class, 'xoaItem'])->name('cart.remove');
Route::post('/gio-hang/xoa-het', [GioHangController::class, 'xoaHet'])->name('cart.clear');
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

    Route::get('/gio-hang', [GioHangController::class, 'index'])->name('cart.index');

    Route::post('/gio-hang/cap-nhat', [GioHangController::class, 'capNhat'])->name('cart.update');

    Route::post('/gio-hang/xoa-het', [GioHangController::class, 'xoaHet'])->name('cart.clear');

    Route::get('/lich-su-mua-hang', fn() => view('pages.lich-su-mua-hang'));

    Route::get('/don-hang', [DonHangController::class, 'index'])
        ->name('donhang.index');

    Route::get('/don-hang/{id}', [DonHangController::class, 'show'])
        ->name('donhang.show');
    Route::post('/don-hang/huy/{id}', [DonHangController::class, 'huy'])
        ->name('donhang.huy');
    Route::get('/thong-tin-ca-nhan', [ProfileController::class, 'index']);
    Route::post('/thong-tin-ca-nhan', [ProfileController::class, 'update']);

    Route::get('/doi-mat-khau', fn() => view('auth.doi-mat-khau'));
    Route::post('/doi-mat-khau', [AuthController::class, 'doiMatKhau']);
});


Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('admin.login.form');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('admin.login');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('admin.logout');
});


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

        Route::get('/thuong-hieu', [ThuongHieuController::class, 'index'])->name('thuonghieu.index');
        Route::get('/thuong-hieu/create', [ThuongHieuController::class, 'create'])->name('thuonghieu.create');
        Route::post('/thuong-hieu/store', [ThuongHieuController::class, 'store'])->name('thuonghieu.store');
        Route::get('/thuong-hieu/edit/{id}', [ThuongHieuController::class, 'edit'])->name('thuonghieu.edit');
        Route::put('/thuong-hieu/update/{id}', [ThuongHieuController::class, 'update'])->name('thuonghieu.update');
        Route::post('/thuong-hieu/destroy/{id}', [ThuongHieuController::class, 'destroy'])->name('thuonghieu.destroy');
        Route::post('/thuong-hieu/restore/{id}', [ThuongHieuController::class, 'restore'])->name('thuonghieu.restore');

        //route quản lý liên hệ(nghia)
        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::put('/contacts/{id}', [AdminContactController::class, 'update'])->name('contacts.update');
        Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

        // route Thong tin công ty (nghia)
        Route::get('/company-info', [AdminCompanyInfoController::class, 'edit'])->name('company-info.edit');
        Route::put('/company-info', [AdminCompanyInfoController::class, 'update'])->name('company-info.update');

        // route Chính sách
        Route::get('/policies', [AdminCompanyInfoController::class, 'policiesIndex'])->name('policies.index');
        Route::get('/policies/create', [AdminCompanyInfoController::class, 'policiesCreate'])->name('policies.create');
        Route::post('/policies', [AdminCompanyInfoController::class, 'policiesStore'])->name('policies.store');
        Route::get('/policies/{id}/edit', [AdminCompanyInfoController::class, 'policiesEdit'])->name('policies.edit');
        Route::put('/policies/{id}', [AdminCompanyInfoController::class, 'policiesUpdate'])->name('policies.update');
        Route::delete('/policies/{id}', [AdminCompanyInfoController::class, 'policiesDestroy'])->name('policies.destroy');

        // route FAQ
        Route::get('/faqs', [AdminCompanyInfoController::class, 'faqsIndex'])->name('faqs.index');
        Route::get('/faqs/create', [AdminCompanyInfoController::class, 'faqsCreate'])->name('faqs.create');
        Route::post('/faqs', [AdminCompanyInfoController::class, 'faqsStore'])->name('faqs.store');
        Route::get('/faqs/{id}/edit', [AdminCompanyInfoController::class, 'faqsEdit'])->name('faqs.edit');
        Route::put('/faqs/{id}', [AdminCompanyInfoController::class, 'faqsUpdate'])->name('faqs.update');
        Route::delete('/faqs/{id}', [AdminCompanyInfoController::class, 'faqsDestroy'])->name('faqs.destroy');
    });
Route::prefix('admin/khuyen-mai')->name('admin.khuyenmai.')->group(function () {

    Route::get('/', [KhuyenMaiController::class, 'index'])->name('index');

    Route::get('/create', [KhuyenMaiController::class, 'create'])->name('create');

    Route::post('/store', [KhuyenMaiController::class, 'store'])->name('store');

    Route::get('/edit/{id}', [KhuyenMaiController::class, 'edit'])->name('edit');

    Route::put('/update/{id}', [KhuyenMaiController::class, 'update'])->name('update');

    Route::post('/delete/{id}', [KhuyenMaiController::class, 'destroy'])->name('destroy');

    Route::post('/restore/{id}', [KhuyenMaiController::class, 'restore'])->name('restore');
});
