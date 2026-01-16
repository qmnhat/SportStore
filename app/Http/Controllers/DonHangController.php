<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    public function index()
    {
        $kh = session('khachhang');

        if (!$kh) {
            return redirect('/dang-nhap');
        }

        $maKH = $kh['MaKH'];

        $query = DonHang::where('MaKH', $maKH)
            ->where('IsDeleted', false);

        // LỌC TRẠNG THÁI
        if (request()->filled('trangthai') && request('trangthai') !== 'all') {
            $query->where('TrangThai', request('trangthai'));
        }

        // SẮP XẾP
        if (request('sort') === 'old') {
            $query->orderBy('NgayDat', 'asc');
        } else {
            $query->orderBy('NgayDat', 'desc');
        }

        $donHangs = $query->get();

        return view('pages.don-hang', compact('donHangs'));
    }


    public function show($id)
    {
        $kh = session('khachhang');

        if (!$kh) {
            return redirect('/dang-nhap');
        }

        $maKH = $kh['MaKH'];

        $donHang = DonHang::where('MaDH', $id)
            ->where('MaKH', $maKH)
            ->where('IsDeleted', false)
            ->firstOrFail();

        $chiTiet = DB::table('ChiTietDonHang')
            ->join('BienTheSanPham', 'ChiTietDonHang.MaBT', '=', 'BienTheSanPham.MaBT')
            ->join('SanPham', 'BienTheSanPham.MaSP', '=', 'SanPham.MaSP')
            ->where('ChiTietDonHang.MaDH', $id)
            ->select(
                'SanPham.TenSP',
                'BienTheSanPham.GiaGoc',
                'ChiTietDonHang.SoLuong'
            )
            ->get();

        return view('pages.chi-tiet-don-hang', compact('donHang', 'chiTiet'));
    }
    public function huy($id)
    {
        $kh = session('khachhang');

        if (!$kh) {
            return redirect('/dang-nhap');
        }

        $maKH = $kh['MaKH'];

        $donHang = DonHang::where('MaDH', $id)
            ->where('MaKH', $maKH)
            ->where('TrangThai', 0) // chỉ hủy khi chờ xác nhận
            ->where('IsDeleted', 0)
            ->first();

        if (!$donHang) {
            return back()->with('error', 'Không thể hủy đơn này');
        }

        $donHang->update([
            'TrangThai' => 3
        ]);

        return back()->with('success', 'Đã hủy đơn hàng');
    }
}
