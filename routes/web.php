<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\ThuongHieuController;
use App\Http\Controllers\Admin\AdminDanhMucController;
use App\Http\Controllers\Admin\AdminKichThuocController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\SanPhamApiController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\Admin\KhuyenMaiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminCompanyInfoController;
use Faker\Provider\Company;
use App\Http\Controllers\NhaCungCapController;
use App\Http\Controllers\YeuThichController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminDonHangController;
use App\Http\Controllers\BaiVietController;
use App\Http\Controllers\Admin\AdminBaiVietController;
use App\Http\Controllers\Admin\AdminBlogCategoryController;
use App\Http\Controllers\Admin\AdminSanPhamController;
//route liên hệ(nghia)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

//route bài viết blog,ct_baiviet
Route::get('/blog', [BaiVietController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BaiVietController::class, 'show'])->name('blog.show');

Route::get('/', [PageController::class, 'trangChu'])->name('home');

//end phat

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIC)
|--------------------------------------------------------------------------
*/


Route::post('/dang-nhap', [AuthController::class, 'loginKhachHang']);
Route::post('/dang-ky', [AuthController::class, 'registerKhachHang']);
Route::get('/dang-nhap', fn() => view('auth.login'))->name('dang-nhap');
Route::get('/dang-ky', fn() => view('auth.register'))->name('dang-ky');
Route::get('/dang-xuat', function () {
    session()->forget('khachhang');
    return redirect('/');
});

Route::get('/gioi-thieu', [PageController::class, 'gioiThieu'])->name('pages.gioi-thieu');
Route::get('/san-pham', [SanPhamController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{slug}', [SanPhamController::class, 'show'])->name('shop.show');

// (15) Them vao gio hang
Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('cart.add');
// (17) Thong ke realtime: view/yeu thich/rating



Route::get('/lien-he', fn() => view('pages.lien-he'));

/*
|--------------------------------------------------------------------------
| AUTH KHÁCH HÀNG
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect()->route('admin.login.form');
})->name('login');

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

    Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('cart.add');

    Route::post('/gio-hang/cap-nhat', [GioHangController::class, 'capNhat'])->name('cart.update');

    Route::post('/gio-hang/xoa', [GioHangController::class, 'xoaItem'])->name('cart.remove');

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

    // ===== THANH TOÁN =====
    Route::get('/thanh-toan', [DonHangController::class, 'checkout'])
        ->name('checkout');

    Route::post('/thanh-toan', [DonHangController::class, 'processCheckout'])
        ->name('checkout.process');


    Route::post('/yeu-thich/toggle', [YeuThichController::class, 'toggle'])
        ->name('yeuthich.toggle');
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


        Route::get('/dashboard', [DashboardController::class, 'index'])
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

        // DANH MỤC
        Route::get('/danh-muc', [AdminDanhMucController::class, 'index'])
            ->name('danhmuc.index');

        Route::get('/danh-muc/create', [AdminDanhMucController::class, 'create'])
            ->name('danhmuc.create');

        Route::post('/danh-muc/store', [AdminDanhMucController::class, 'store'])
            ->name('danhmuc.store');

        Route::get('/danh-muc/edit/{id}', [AdminDanhMucController::class, 'edit'])
            ->name('danhmuc.edit');

        Route::put('/danh-muc/update/{id}', [AdminDanhMucController::class, 'update'])
            ->name('danhmuc.update');

        Route::post('/danh-muc/destroy/{id}', [AdminDanhMucController::class, 'destroy'])
            ->name('danhmuc.destroy');

        Route::post('/danh-muc/restore/{id}', [AdminDanhMucController::class, 'restore'])
            ->name('danhmuc.restore');

        // KÍCH THƯỚC
        Route::get('/kich-thuoc', [AdminKichThuocController::class, 'index'])
            ->name('kichthuoc.index');

        Route::get('/kich-thuoc/create', [AdminKichThuocController::class, 'create'])
            ->name('kichthuoc.create');

        Route::post('/kich-thuoc/store', [AdminKichThuocController::class, 'store'])
            ->name('kichthuoc.store');

        Route::get('/kich-thuoc/edit/{id}', [AdminKichThuocController::class, 'edit'])
            ->name('kichthuoc.edit');

        Route::put('/kich-thuoc/update/{id}', [AdminKichThuocController::class, 'update'])
            ->name('kichthuoc.update');

        Route::post('/kich-thuoc/destroy/{id}', [AdminKichThuocController::class, 'destroy'])
            ->name('kichthuoc.destroy');

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

        //sản phẩm

        Route::get('/san-pham', [AdminSanPhamController::class, 'index'])->name('sanpham.index');
        Route::get('/san-pham/create', [AdminSanPhamController::class, 'create'])->name('sanpham.create');
        Route::post('/san-pham/store', [AdminSanPhamController::class, 'store'])->name('sanpham.store');
        Route::get('/san-pham/edit/{id}', [AdminSanPhamController::class, 'edit'])->name('sanpham.edit');
        Route::put('/san-pham/update/{id}', [AdminSanPhamController::class, 'update'])->name('sanpham.update');
        Route::post('/san-pham/destroy/{id}', [AdminSanPhamController::class, 'destroy'])->name('sanpham.destroy');
        Route::post('/san-pham/restore/{id}', [AdminSanPhamController::class, 'restore'])->name('sanpham.restore');

        Route::get('/don-hang', [AdminDonHangController::class, 'index'])
            ->name('donhang.index');

        Route::post('/don-hang/{id}/cancel', [AdminDonHangController::class, 'cancel'])
            ->name('donhang.cancel');

        Route::post('/don-hang/{id}/status', [AdminDonHangController::class, 'updateStatus'])
            ->name('donhang.updateStatus');

        Route::get('/don-hang/{id}', [AdminDonHangController::class, 'show'])
            ->name('donhang.show');

        // BLOG - DANH MỤC BÀI VIẾT
        Route::resource('blog-category', AdminBlogCategoryController::class, [
            'names' => 'blog-category',
            'parameters' => ['blog_category' => 'blogCategory'],
        ]);

        // BLOG - BÀI VIẾT
        Route::resource('bai-viet', AdminBaiVietController::class, [
            'names' => 'bai-viet',
            'parameters' => ['bai_viet' => 'baiViet'],
        ]);
        Route::delete('bai-viet/{id}/force', [AdminBaiVietController::class, 'forceDelete'])
            ->name('bai-viet.forceDelete');
        Route::post('bai-viet/{id}/restore', [AdminBaiVietController::class, 'restore'])
            ->name('bai-viet.restore');
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
Route::prefix('admin')->group(function () {

    Route::get('/nha-cung-cap', [NhaCungCapController::class, 'index']);
    Route::get('/nha-cung-cap/create', [NhaCungCapController::class, 'create']);
    Route::post('/nha-cung-cap/store', [NhaCungCapController::class, 'store']);

    Route::get('/nha-cung-cap/edit/{id}', [NhaCungCapController::class, 'edit']);
    Route::post('/nha-cung-cap/update/{id}', [NhaCungCapController::class, 'update']);
    Route::get('/nha-cung-cap/delete/{id}', [NhaCungCapController::class, 'delete']);
});
