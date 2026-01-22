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
            ->where('IsDeleted', 0)
            ->first();
        if (!$kh) {
            return back()->with('error', 'Email không tồn tại');
        }
        if ($kh->TrangThai == 0) {
            return back()->with('error', 'Tài khoản đã bị khóa');
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
        $request->validate([
            'HoTen'           => 'required|string|max:255',
            'Email'           => 'required|email|unique:KhachHang,Email',
            'MatKhau'         => 'required|min:6',
            'MatKhau_confirm' => 'required|same:MatKhau',
            'SoDienThoai'     => 'nullable|numeric',
        ], [
            'Email.unique'         => 'Email này đã được sử dụng. Vui lòng chọn email khác.',
            'MatKhau_confirm.same' => 'Mật khẩu nhập lại không khớp.',
            'MatKhau.min'          => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'HoTen.required'       => 'Vui lòng nhập họ tên.',
        ]);
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
        return redirect('/dang-nhap')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
    public function doiMatKhau(Request $request)
    {
        $kh = session('khachhang');
        if (!$kh) {
            return redirect('/dang-nhap');
        }

        // Validation
        $request->validate([
            'MatKhauCu' => 'required',
            'MatKhauMoi' => 'required|min:6',
            'MatKhauMoi_confirm' => 'required|same:MatKhauMoi',
        ], [
            'MatKhauCu.required' => 'Vui lòng nhập mật khẩu cũ',
            'MatKhauMoi.required' => 'Vui lòng nhập mật khẩu mới',
            'MatKhauMoi.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự',
            'MatKhauMoi_confirm.required' => 'Vui lòng xác nhận mật khẩu mới',
            'MatKhauMoi_confirm.same' => 'Xác nhận mật khẩu không khớp',
        ]);

        $khDb = DB::table('KhachHang')
            ->where('MaKH', $kh['MaKH'])
            ->first();

        if (!Hash::check($request->MatKhauCu, $khDb->MatKhau)) {
            return back()->with('error', 'Mật khẩu cũ không đúng');
        }

        DB::table('KhachHang')
            ->where('MaKH', $kh['MaKH'])
            ->update([
                'MatKhau' => Hash::make($request->MatKhauMoi),
            ]);

        return redirect('/')->with('success', 'Đổi mật khẩu thành công');
    }
}
