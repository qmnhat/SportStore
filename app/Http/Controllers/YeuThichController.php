<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ✅ THÊM DÒNG NÀY

class YeuThichController extends Controller
{
    public function toggle(Request $request)
    {
        $kh = session('khachhang');
        if (!$kh) {
            return response()->json(['message' => 'Chua dang nhap'], 401);
        }
        $request->validate([
            'MaSP' => 'required|integer',
        ]);
        $maKH = (int) $kh['MaKH'];
        $maSP = (int) $request->MaSP;
        $exists = DB::table('YeuThich')
            ->where('MaKH', $maKH)
            ->where('MaSP', $maSP)
            ->exists();

        if ($exists) {
            DB::table('YeuThich')
                ->where('MaKH', $maKH)
                ->where('MaSP', $maSP)
                ->delete();

            return response()->json(['status' => 'removed']);
        }
        DB::table('YeuThich')->insert([
            'MaKH' => $maKH,
            'MaSP' => $maSP,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return response()->json(['status' => 'added']);
    }
}
