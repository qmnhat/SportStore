<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\ThuongHieuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminCompanyInfoController;
use Faker\Provider\Company;

//route liên hệ(nghia)
Route::post('/contact',[ContactController::class, 'store'])->name('contact.store');


/*
|--------------------------------------------------------------------------
| FRONTEND (KHÁCH HÀNG)
|--------------------------------------------------------------------------
*/
Route::middleware('khachhang.auth')->group(function () {

    Route::get('/gio-hang', fn() => view('pages.gio-hang'));
    Route::get('/lich-su-mua-hang', fn() => view('pages.lich-su-mua-hang'));
    Route::get('/don-hang', fn() => view('pages.don-hang'));
    Route::get('/don-hang/{id}', fn($id) => view('pages.chi-tiet-don-hang'));

    Route::get('/thong-tin-ca-nhan', [ProfileController::class, 'index']);
    Route::post('/thong-tin-ca-nhan', [ProfileController::class, 'update']);

    Route::get('/doi-mat-khau', fn() => view('auth.doi-mat-khau'));
    Route::post('/doi-mat-khau', [AuthController::class, 'doiMatKhau']);
});




Route::get('/gioi-thieu', [PageController::class, 'gioiThieu'])->name('pages.gioi-thieu');

Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{maSP}', [SanPhamController::class, 'show'])->name('shop.show');
Route::get('/', function () {
    return view('pages.trang-chu');
});
Route::Get('/tim-kiem', [SanPhamController::class, 'search'])->name('search');
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

Route::get('/', function () {
    return view('pages.trang-chu');
});

Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{maSP}', [SanPhamController::class, 'show'])->name('shop.show');




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
| ROUTE LOGIN MẶC ĐỊNH (CHO LARAVEL REDIRECT)
|--------------------------------------------------------------------------
| Laravel 12 cần route tên "login"
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

        // /admin → dashboard
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        // /admin/dashboard
        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | QUẢN LÝ KHÁCH HÀNG
        |--------------------------------------------------------------------------
        */

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

        Route::get('/thuong-hieu', [ThuongHieuController::class, 'index'])->name('thuonghieu.index');
        Route::get('/thuong-hieu/create', [ThuongHieuController::class, 'create'])->name('thuonghieu.create');
        Route::post('/thuong-hieu/store', [ThuongHieuController::class, 'store'])->name('thuonghieu.store');
        Route::get('/thuong-hieu/edit/{id}', [ThuongHieuController::class, 'edit'])->name('thuonghieu.edit');
        Route::put('/thuong-hieu/update/{id}', [ThuongHieuController::class, 'update'])->name('thuonghieu.update');
        Route::post('/thuong-hieu/destroy/{id}', [ThuongHieuController::class, 'destroy'])->name('thuonghieu.destroy');
        Route::post('/thuong-hieu/restore/{id}', [ThuongHieuController::class, 'restore'])->name('thuonghieu.restore');

        //route quản lý liên hệ(nghia)
        Route::get('/contacts',[AdminContactController::class,'index'])->name('contacts.index');
        Route::get('/contacts/{id}',[AdminContactController::class,'show'])->name('contacts.show');
        Route::put('/contacts/{id}',[AdminContactController::class,'update'])->name('contacts.update');
        Route::delete('/contacts/{id}',[AdminContactController::class,'destroy'])->name('contacts.destroy');

        // route Thong tin công ty (nghia)
        Route::get('/company-info',[AdminCompanyInfoController::class,'edit'])->name('company-info.edit');
        Route::put('/company-info',[AdminCompanyInfoController::class,'update'])->name('company-info.update');

        // route Chính sách
        Route::get('/policies',[AdminCompanyInfoController::class,'policiesIndex'])->name('policies.index');
        Route::get('/policies/create',[AdminCompanyInfoController::class,'policiesCreate'])->name('policies.create');
        Route::post('/policies',[AdminCompanyInfoController::class,'policiesStore'])->name('policies.store');
        Route::get('/policies/{id}/edit',[AdminCompanyInfoController::class,'policiesEdit'])->name('policies.edit');
        Route::put('/policies/{id}',[AdminCompanyInfoController::class,'policiesUpdate'])->name('policies.update');
        Route::delete('/policies/{id}',[AdminCompanyInfoController::class,'policiesDestroy'])->name('policies.destroy');

        // route FAQ
        Route::get('/faqs',[AdminCompanyInfoController::class,'faqsIndex'])->name('faqs.index');
        Route::get('/faqs/create',[AdminCompanyInfoController::class,'faqsCreate'])->name('faqs.create');
        Route::post('/faqs',[AdminCompanyInfoController::class,'faqsStore'])->name('faqs.store');
        Route::get('/faqs/{id}/edit',[AdminCompanyInfoController::class,'faqsEdit'])->name('faqs.edit');
        Route::put('/faqs/{id}',[AdminCompanyInfoController::class,'faqsUpdate'])->name('faqs.update');
        Route::delete('/faqs/{id}',[AdminCompanyInfoController::class,'faqsDestroy'])->name('faqs.destroy');


    });
