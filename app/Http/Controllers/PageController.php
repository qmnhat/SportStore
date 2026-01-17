<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\SanPham;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    // Trang giới thiệu
    public function gioiThieu()
    {
        $company = CompanyInfo::find(1);
        return view('pages.gioi-thieu', compact('company'));
    }

    // Alias cho giới thiệu
    public function about()
    {
        return view('pages.gioi-thieu');
    }

    // Trang chủ mới (slider + tab + banner)
    public function trangChu()
    {
        // Slider sản phẩm khuyến mãi cao nhất
        $sliderSanPham = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])
            ->join('sanphamkhuyenmai', 'sanpham.MaSP', '=', 'sanphamkhuyenmai.MaSP')
            ->join('khuyenmai', 'sanphamkhuyenmai.MaKM', '=', 'khuyenmai.MaKM')
            ->orderByDesc('khuyenmai.PhanTramGiam')
            ->select('sanpham.*')
            ->take(3)
            ->get();

        // Tab All
        $allProducts = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])->get();

        // Tab New arrivals
        $newArrivals = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])
            ->orderByDesc('MaSP')
            ->take(8)
            ->get();

        // Tab Featured (tạm)
        $featured = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])
            ->take(8)
            ->get();

        // Tab Top selling (tạm)
        $topSelling = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])
            ->take(8)
            ->get();

        // Banner trái (mới nhất)
        $bannerNoiBat = SanPham::with(['hinhAnh', 'bienThe'])
            ->orderByDesc('MaSP')
            ->first();

        // Banner phải (giảm giá cao nhất)
        $bannerKhuyenMai = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])
            ->join('sanphamkhuyenmai', 'sanpham.MaSP', '=', 'sanphamkhuyenmai.MaSP')
            ->join('khuyenmai', 'sanphamkhuyenmai.MaKM', '=', 'khuyenmai.MaKM')
            ->orderByDesc('khuyenmai.PhanTramGiam')
            ->select('sanpham.*')
            ->first();

        return view('pages.trang-chu', compact(
            'sliderSanPham',
            'allProducts',
            'newArrivals',
            'featured',
            'topSelling',
            'bannerNoiBat',
            'bannerKhuyenMai'
        ));
    }

    // Trang home cũ (Query Builder)
    public function home()
    {
        $sanPhams = DB::table('SanPham as sp')
            ->leftJoin('BienTheSanPham as bt', function ($join) {
                $join->on('bt.MaSP', '=', 'sp.MaSP')
                    ->where('bt.IsDeleted', 0)
                    ->where('bt.TrangThai', 1);
            })
            ->leftJoin('HinhAnhSanPham as ha', 'ha.MaSP', '=', 'sp.MaSP')
            ->where('sp.IsDeleted', 0)
            ->groupBy('sp.MaSP', 'sp.TenSP')
            ->select(
                'sp.MaSP',
                'sp.TenSP',
                DB::raw('MIN(bt.GiaGoc) as giaMin'),
                DB::raw('MIN(ha.DuongDan) as anhDauTien')
            )
            ->orderByDesc('sp.MaSP')
            ->limit(8)
            ->get();

        return view('pages.trang-chu', compact('sanPhams'));
    }
}
