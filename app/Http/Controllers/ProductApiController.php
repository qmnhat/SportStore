<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SanPhamApiController extends Controller
{
    public function thongKe($maSP)
    {
        $maSP = (int) $maSP;

        $tk = DB::table('ThongKeSanPham')->where('MaSP', $maSP)->first();
        if (!$tk) {
            DB::table('ThongKeSanPham')->insert([
                'MaSP' => $maSP,
                'LuotXem' => 0,
                'LuotYeuThich' => 0,
            ]);
            $tk = DB::table('ThongKeSanPham')->where('MaSP', $maSP)->first();
        }

        $soDanhGia = DB::table('DanhGia')->where('MaSP', $maSP)->count();
        $saoTb = DB::table('DanhGia')->where('MaSP', $maSP)->avg('SoSao') ?? 0;

        return response()->json([
            'luotXem' => (int) $tk->LuotXem,
            'luotYeuThich' => (int) $tk->LuotYeuThich,
            'soDanhGia' => (int) $soDanhGia,
            'saoTrungBinh' => round((float) $saoTb, 1),
        ]);
    }

    public function yeuThich($maSP)
    {
        $maSP = (int) $maSP;

        DB::table('ThongKeSanPham')->updateOrInsert(
            ['MaSP' => $maSP],
            ['LuotXem' => DB::raw('LuotXem'), 'LuotYeuThich' => DB::raw('COALESCE(LuotYeuThich,0) + 1')]
        );
        return response()->json(['ok' => true]);
    }
}
