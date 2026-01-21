<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class CartHelper
{
    public static function getCartInfo()
    {
        $kh = session('khachhang');
        if (!$kh) {
            return [
                'soLuong' => 0,
                'tongTien' => 0,
            ];
        }

        $maKH = (int) ($kh['MaKH'] ?? 0);

        $gioHang = DB::table('GioHang')
            ->where('MaKH', $maKH)
            ->first();

        if (!$gioHang) {
            return [
                'soLuong' => 0,
                'tongTien' => 0,
            ];
        }

        $maGH = (int) $gioHang->MaGH;

        // Lấy thông tin chi tiết giỏ hàng
        $items = DB::table('ChiTietGioHang as ct')
            ->join('BienTheSanPham as bt', 'bt.MaBT', '=', 'ct.MaBT')
            ->where('ct.MaGH', $maGH)
            ->select(
                'ct.SoLuong',
                'bt.GiaGoc'
            )
            ->get();

        $soLuong = 0;
        $tongTien = 0;

        foreach ($items as $item) {
            $soLuong += (int) $item->SoLuong;
            $tongTien += ((float) $item->GiaGoc) * ((int) $item->SoLuong);
        }

        return [
            'soLuong' => $soLuong,
            'tongTien' => number_format($tongTien, 0, ',', '.'),
        ];
    }
}
