<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GioHangController extends Controller
{
    public function them(Request $request)
    {
        $kh = session('khachhang');
        if (!$kh) {
            return redirect('/dang-nhap');
        }

        $request->validate([
            'MaBT' => 'required|integer',
            'SoLuong' => 'required|integer|min:1',
        ]);

        $maBT = (int) $request->MaBT;
        $soLuong = (int) $request->SoLuong;
        $maKH = (int) $kh['MaKH'];

        // check bien the ton tai + ton kho
        $bt = DB::table('BienTheSanPham')
            ->where('MaBT', $maBT)
            ->where('IsDeleted', 0)
            ->where('TrangThai', 1)
            ->first();

        if (!$bt) {
            return back()->with('error', 'Bien the khong ton tai');
        }

        if ($bt->SoLuong < $soLuong) {
            return back()->with('error', 'So luong vuot ton kho');
        }

        // tao gio hang neu chua co
        $gioHang = DB::table('GioHang')->where('MaKH', $maKH)->first();
        if (!$gioHang) {
            $maGH = DB::table('GioHang')->insertGetId([
                'MaKH' => $maKH,
                'NgayTao' => now(),
            ]);
        } else {
            $maGH = (int) $gioHang->MaGH;
        }

        // upsert chi tiet gio hang
        $ct = DB::table('ChiTietGioHang')
            ->where('MaGH', $maGH)
            ->where('MaBT', $maBT)
            ->first();

        if ($ct) {
            $moi = (int) $ct->SoLuong + $soLuong;

            if ($bt->SoLuong < $moi) {
                return back()->with('error', 'Tong so luong trong gio vuot ton kho');
            }

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

        return back()->with('success', 'Da them vao gio hang');
    }
}
