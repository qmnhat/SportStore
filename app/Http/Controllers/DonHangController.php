<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use Illuminate\Http\Request;
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
            ->where('IsDeleted', 0);

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
            ->where('IsDeleted', 0)
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
    public function checkout()
    {
        $kh = session('khachhang');
        if (!$kh) {
            return redirect('/dang-nhap');
        }

        $maKH = (int)$kh['MaKH'];

        // 1. Lấy giỏ hàng
        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        if (!$gioHang) {
            return redirect()->route('cart.index')
                ->with('error', 'Giỏ hàng trống, không thể thanh toán');
        }

        $maGH = (int)$gioHang->MaGH;

        // 2. Lấy chi tiết giỏ
        $items = DB::table('ChiTietGioHang as ct')
            ->join('BienTheSanPham as bt', 'bt.MaBT', '=', 'ct.MaBT')
            ->join('SanPham as sp', 'sp.MaSP', '=', 'bt.MaSP')
            ->leftJoin('KichThuoc as kt', 'kt.MaKT', '=', 'bt.MaKT')
            ->where('ct.MaGH', $maGH)
            ->select(
                'ct.MaBT',
                'ct.SoLuong',
                'bt.GiaGoc',
                'sp.TenSP',
                'kt.TenKT'
            )
            ->get();

        if ($items->count() === 0) {
            return redirect()->route('cart.index')
                ->with('error', 'Giỏ hàng trống, không thể thanh toán');
        }

        // 3. Tính tiền
        $tamTinh = 0;
        foreach ($items as $it) {
            $tamTinh += $it->GiaGoc * $it->SoLuong;
        }

        $phiShip = 30000;
        $tong = $tamTinh + $phiShip;

        return view('pages.thanh-toan', compact(
            'items',
            'tamTinh',
            'phiShip',
            'tong'
        ));
    }
    public function processCheckout(Request $request)
    {
        $kh = session('khachhang');
        if (!$kh) {
            return redirect('/dang-nhap');
        }

        $maKH = (int) $kh['MaKH'];

        $request->validate([
            'ho_ten' => 'required',
            'dien_thoai' => 'required',
            'dia_chi' => 'required',
            'phuong_thuc' => 'required|in:cod,bank',
        ]);

        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        if (!$gioHang) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        // ✅ CHỈ LẤY NHỮNG GÌ DB CÓ
        $items = DB::table('ChiTietGioHang')
            ->where('MaGH', $gioHang->MaGH)
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');
        }

        DB::beginTransaction();
        try {

            // ✅ TẠO ĐƠN HÀNG DUY NHẤT
            $donHang = DonHang::create([
                'MaKH' => $maKH,
                'NgayDat' => now(),
                'TrangThai' => 0,
                'IsDeleted' => 0
            ]);

            foreach ($items as $it) {
                DB::table('ChiTietDonHang')->insert([
                    'MaDH'    => $donHang->MaDH,
                    'MaBT'    => $it->MaBT,
                    'SoLuong' => $it->SoLuong,
                ]);
            }

            DB::table('ChiTietGioHang')
                ->where('MaGH', $gioHang->MaGH)
                ->delete();

            DB::commit();

            return redirect()->route('donhang.index')
                ->with('success', 'Đặt hàng thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }


}
