<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\KhachHang;

class AuthController extends Controller
{
    public function loginKhachHang(Request $request)
    {
        $request->validate([
            'Email'   => 'required|email',
            'MatKhau' => 'required',
        ]);

        $kh = DB::table('KhachHang')
            ->where('Email', $request->Email)
            ->where('TrangThai', 1)
            ->where('IsDeleted', 0)
            ->first();

        if (!$kh) {
            return back()->with('error', 'Email không tồn tại');
        }

        if (!Hash::check($request->MatKhau, $kh->MatKhau)) {
            return back()->with('error', 'Mật khẩu không đúng');
        }

        session([
            'khachhang' => [
                'MaKH'  => $kh->MaKH,
                'HoTen' => $kh->HoTen,
                'Email' => $kh->Email,
            ]
        ]);

        return redirect('/');
    }

    public function registerKhachHang(Request $request)
    {
        // kiểm tra mật khẩu nhập lại
        if ($request->MatKhau !== $request->MatKhau_confirm) {
            return back();
        }

        DB::table('KhachHang')->insert([
            'HoTen'     => $request->HoTen,
            'Email'     => $request->Email,
            'MatKhau'   => Hash::make($request->MatKhau),
            'SDT'       => $request->SoDienThoai ?? null,
            'DiaChi'    => $request->DiaChi ?? null,
            'NgaySinh'  => $request->NgaySinh ?? null,
            'TrangThai' => 1,
            'IsDeleted' => 0,
            'NgayTao'   => now(),
        ]);

        return redirect('/dang-nhap');
    }
    public function doiMatKhau(Request $request)
    {
        $kh = session('khachhang');

        if (!$kh) {
            return redirect('/dang-nhap');
        }

        $khDb = DB::table('KhachHang')
            ->where('MaKH', $kh['MaKH'])
            ->first();

        // check mật khẩu cũ
        if (!Hash::check($request->MatKhauCu, $khDb->MatKhau)) {
            return back();
        }

        // check nhập lại
        if ($request->MatKhauMoi !== $request->MatKhauMoi_confirm) {
            return back();
        }

        DB::table('KhachHang')
            ->where('MaKH', $kh['MaKH'])
            ->update([
                'MatKhau' => Hash::make($request->MatKhauMoi),
            ]);

        return redirect('/');
    }
}
