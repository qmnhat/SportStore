<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\SanPham;
use App\Models\DonHang;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $tongSanPham = SanPham::count();
        $tongDonHang = DonHang::count();
        $tongNguoiDung = User::count();

        // ✅ TỔNG DOANH THU
        $tongDoanhThu = HoaDon::where('IsDeleted', 0)
            ->sum('TongTien');

        return view('admin.dashboard', compact(
            'tongSanPham',
            'tongDonHang',
            'tongNguoiDung',
            'tongDoanhThu'
        ));
    }
}
