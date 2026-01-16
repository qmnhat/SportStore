<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;  

class PageController extends Controller
{
    public function trangChu()
    {
        // Slider: sản phẩm nổi bật / khuyến mãi (lấy tạm)
        $sliderSanPham = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])
        ->join('sanphamkhuyenmai', 'sanpham.MaSP', '=', 'sanphamkhuyenmai.MaSP')
        ->join('khuyenmai', 'sanphamkhuyenmai.MaKM', '=', 'khuyenmai.MaKM')
        ->orderByDesc('khuyenmai.PhanTramGiam')
        ->select('sanpham.*')
        ->take(3)
        ->get();
        // TAB 1: All Products
        $allProducts   = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])->get();

        // TAB 2: New Arrivals
        $newArrivals   = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])->orderBy('MaSP', 'desc')->take(8)->get();

        // TAB 3: Featured
        $featured      = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])->take(8)->get();

        // TAB 4: Top Selling (tạm)
        $topSelling    = SanPham::with(['hinhAnh', 'bienThe', 'khuyenMai'])->take(8)->get();

        // Banner trái: 1 sản phẩm nổi bật (lấy mới nhất)
        $bannerNoiBat = SanPham::with(['hinhAnh', 'bienThe'])
            ->orderByDesc('MaSP')
            ->first();

        // Banner phải: sản phẩm giảm giá cao nhất
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
    public function about()
    {
        return view('pages.gioi-thieu');
    }
}
