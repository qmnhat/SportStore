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
        $company = CompanyInfo::first();
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
        // Slider sản phẩm
        $sliderSanPham = SanPham::where('NoiBat', 1)->take(6)->get();
        $sanPhamKhuyenMai = SanPham::whereHas('khuyenMai')->take(6)->get();
        $spNoiBat = SanPham::with('hinhAnh')
            ->leftJoin('ThongKeSanPham as tk', 'SanPham.MaSP', '=', 'tk.MaSP')
            ->where('SanPham.IsDeleted', 0)
            ->where('SanPham.TrangThai', 1)
            ->select('SanPham.*')
            ->orderByDesc(DB::raw('COALESCE(tk.LuotXem,0)'))
            ->take(6)
            ->get();
        $spKhuyenMai = SanPham::with('hinhAnh')
            ->join('SanPhamKhuyenMai', 'SanPham.MaSP', '=', 'SanPhamKhuyenMai.MaSP')
            ->join('KhuyenMai', 'SanPhamKhuyenMai.MaKM', '=', 'KhuyenMai.MaKM')
            ->where('SanPham.IsDeleted', 0)
            ->where('SanPham.TrangThai', 1)
            ->select('SanPham.*')
            ->orderByDesc('KhuyenMai.PhanTramGiam')
            ->take(6)
            ->get();
        $bannerQuangCao = [
            ['img' => 'img/nghia.jpg', 'link' => route('shop.index')],
            ['img' => 'img/ahihi.jpg', 'link' => route('shop.index')],
            ];
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
        // 1) Lay MaSP + DaBan (GROUP BY chi tren MaSP)
        $topIds = DB::table('SanPham as sp')
            ->join('BienTheSanPham as bt', 'bt.MaSP', '=', 'sp.MaSP')
            ->join('ChiTietDonHang as ct', 'ct.MaBT', '=', 'bt.MaBT')
            ->where('sp.IsDeleted', 0)
            ->groupBy('sp.MaSP')
            ->orderByDesc(DB::raw('SUM(ct.SoLuong)'))
            ->limit(8)
            ->pluck('sp.MaSP')
            ->toArray();

        // 2) Lay day du SanPham theo danh sach MaSP (khong GROUP BY nua)
        $topSelling = SanPham::with(['hinhAnh', 'khuyenMai'])
            ->whereIn('MaSP', $topIds)
            ->get()
            ->sortBy(function ($sp) use ($topIds) {
                return array_search($sp->MaSP, $topIds);
            })
            ->values();

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
            'spNoiBat',
            'spKhuyenMai',
            'newArrivals',
            'featured',
            'topSelling',
            'bannerNoiBat',
            'bannerKhuyenMai',
            'sliderSanPham',
            'sanPhamKhuyenMai',
            'bannerQuangCao'
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
