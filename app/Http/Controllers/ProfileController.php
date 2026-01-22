<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        if (!session()->has('khachhang')) {
            return redirect('/dang-nhap');
        }

        $kh = DB::table('KhachHang')
            ->where('MaKH', session('khachhang.MaKH'))
            ->first();

        return view('pages.thong-tin-ca-nhan', compact('kh'));
    }

    public function update(Request $request)
    {
        if (!session()->has('khachhang')) {
            return redirect('/dang-nhap');
        }

        DB::table('KhachHang')
            ->where('MaKH', session('khachhang.MaKH'))
            ->update([
                'HoTen'     => $request->HoTen,
                'NgaySinh'  => $request->NgaySinh,
                'SDT'       => $request->SDT,
                'DiaChi'    => $request->DiaChi,
                'GioiTinh'  => $request->GioiTinh,
            ]);


        // cập nhật lại session cho đồng bộ tên
        session()->put('khachhang.HoTen', $request->HoTen);

        return back()->with('success', 'Cập nhật thành công');
    }
}
