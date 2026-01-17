<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    // (15) Thêm vào giỏ hàng
    public function them(Request $request)
    {
        $kh = session('khachhang');
        if (!$kh) return redirect('/dang-nhap');

        $request->validate([
            'MaBT' => 'required|integer',
            'SoLuong' => 'required|integer|min:1',
        ]);

        $maBT = (int) $request->MaBT;
        $soLuong = (int) $request->SoLuong;
        $maKH = (int) $kh['MaKH'];

        $bt = DB::table('BienTheSanPham')
            ->where('MaBT', $maBT)
            ->where('IsDeleted', 0)
            ->where('TrangThai', 1)
            ->first();

        if (!$bt) return back()->with('error', 'Biến thể không tồn tại.');
        if ((int)$bt->SoLuong < $soLuong) return back()->with('error', 'Số lượng vượt tồn kho.');

        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        if (!$gioHang) {
            $maGH = DB::table('GioHang')->insertGetId([
                'MaKH' => $maKH,
                'NgayTao' => now(),
            ]);
        } else {
            $maGH = (int) $gioHang->MaGH;
        }

        $ct = DB::table('ChiTietGioHang')
            ->where('MaGH', $maGH)
            ->where('MaBT', $maBT)
            ->first();

        if ($ct) {
            $moi = (int) $ct->SoLuong + $soLuong;
            if ((int)$bt->SoLuong < $moi) return back()->with('error', 'Tổng số lượng trong giỏ vượt tồn kho.');

            DB::table('ChiTietGioHang')
                ->where('MaGH', $maGH)
                ->where('MaBT', $maBT)
                ->update(['SoLuong' => $moi]);
        } else {
            DB::table('ChiTietGioHang')->insert([
                'MaGH' => $maGH,
                'MaBT' => $maBT,
                'SoLuong' => $soLuong,
            ]);
        }

        // về trang giỏ để thấy rõ đã thêm
        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng.');
    }

    // (24)(27) Hiển thị giỏ + phân trang
    public function index()
    {
        $kh = session('khachhang');
        $maKH = (int) ($kh['MaKH'] ?? 0);

        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        $maGH = $gioHang ? (int)$gioHang->MaGH : 0;

        if ($maGH === 0) {
            // trả giỏ trống đúng nghĩa
            $items = DB::table('ChiTietGioHang')->whereRaw('1=0')->paginate(6);
            $tamTinh = 0;
            $phiShip = 0;
            $tong = 0;
            return view('pages.gio-hang', compact('items', 'tamTinh', 'phiShip', 'tong'));
        }

        $items = DB::table('ChiTietGioHang as ct')
            ->join('BienTheSanPham as bt', 'bt.MaBT', '=', 'ct.MaBT')
            ->join('SanPham as sp', 'sp.MaSP', '=', 'bt.MaSP')
            ->leftJoin('KichThuoc as kt', 'kt.MaKT', '=', 'bt.MaKT')
            ->leftJoin('HinhAnhSanPham as ha', 'ha.MaSP', '=', 'sp.MaSP')
            ->where('ct.MaGH', $maGH)
            ->groupBy('ct.MaBT','ct.SoLuong','bt.GiaGoc','sp.MaSP','sp.TenSP','kt.TenKT')
            ->select(
                'ct.MaBT','ct.SoLuong',
                'bt.GiaGoc',
                'sp.MaSP','sp.TenSP',
                'kt.TenKT',
                DB::raw('MIN(ha.DuongDan) as anhDauTien')
            )
            ->orderByDesc('sp.MaSP')
            ->paginate(6); // (27)

        $tamTinh = 0;
        foreach ($items as $it) {
            $tamTinh += ((float)$it->GiaGoc) * ((int)$it->SoLuong);
        }

        $phiShip = $tamTinh > 0 ? 30000 : 0;
        $tong = $tamTinh + $phiShip;

        return view('pages.gio-hang', compact('items','tamTinh','phiShip','tong'));
    }

    // (25) Cập nhật số lượng
    public function capNhat(Request $request)
    {
        $kh = session('khachhang');
        $maKH = (int) ($kh['MaKH'] ?? 0);

        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        if (!$gioHang) return redirect()->route('cart.index');

        $maGH = (int)$gioHang->MaGH;
        $ds = $request->input('soLuong', []); // soLuong[MaBT] = sl

        foreach ($ds as $maBT => $sl) {
            $maBT = (int)$maBT;
            $sl = max(1, (int)$sl);

            $bt = DB::table('BienTheSanPham')->where('MaBT', $maBT)->first();
            if (!$bt) continue;

            $ton = (int)($bt->SoLuong ?? 0);
            if ($ton <= 0) $sl = 1;
            if ($sl > $ton) $sl = $ton;

            DB::table('ChiTietGioHang')
                ->where('MaGH', $maGH)
                ->where('MaBT', $maBT)
                ->update(['SoLuong' => $sl]);
        }

        return back()->with('success', 'Đã cập nhật giỏ hàng.');
    }

    // Xóa 1 dòng sản phẩm trong giỏ
    public function xoaItem(Request $request)
    {
        $kh = session('khachhang');
        $maKH = (int) ($kh['MaKH'] ?? 0);

        $request->validate([
            'MaBT' => 'required|integer'
        ]);

        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        if (!$gioHang) return back();

        DB::table('ChiTietGioHang')
            ->where('MaGH', (int)$gioHang->MaGH)
            ->where('MaBT', (int)$request->MaBT)
            ->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ.');
    }

    // (26) Xóa hết
    public function xoaHet()
    {
        $kh = session('khachhang');
        $maKH = (int) ($kh['MaKH'] ?? 0);

        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        if (!$gioHang) return back();

        DB::table('ChiTietGioHang')
            ->where('MaGH', (int)$gioHang->MaGH)
            ->delete();

        return back()->with('success', 'Đã xóa hết giỏ hàng.');
    }
}
