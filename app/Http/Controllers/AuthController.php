<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function loginKhachHang(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'MatKhau' => 'required',
        ]);

        $kh = DB::table('KhachHang')
            ->where('Email', $request->Email)
            ->where('IsDeleted', 0)
            ->first();

        if (! $kh) {
            return back()->with('error', 'Email không tồn tại');
        }

        if ($kh->TrangThai == 0) {
            return back()->with('error', 'Tài khoản đã bị khóa');
        }

        if (! Hash::check($request->MatKhau, $kh->MatKhau)) {
            return back()->with('error', 'Mật khẩu không đúng');
        }

        session([
            'khachhang' => [
                'MaKH' => $kh->MaKH,
                'HoTen' => $kh->HoTen,
                'Email' => $kh->Email,
            ],
        ]);

        return redirect('/');
    }

    public function registerKhachHang(Request $request)
    {
        $request->validate([
            'HoTen' => 'required|string|max:255',
            'Email' => 'required|email|unique:KhachHang,Email',
            'MatKhau' => 'required|min:6',
            'MatKhau_confirm' => 'required|same:MatKhau',
            'SoDienThoai' => 'nullable|numeric',
        ], [
            'Email.unique' => 'Email này đã được sử dụng. Vui lòng chọn email khác.',
            'MatKhau_confirm.same' => 'Mật khẩu nhập lại không khớp.',
            'MatKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'HoTen.required' => 'Vui lòng nhập họ tên.',
        ]);

        DB::table('KhachHang')->insert([
            'HoTen' => $request->HoTen,
            'Email' => $request->Email,
            'MatKhau' => Hash::make($request->MatKhau),
            'SDT' => $request->SoDienThoai ?? null,
            'DiaChi' => $request->DiaChi ?? null,
            'NgaySinh' => $request->NgaySinh ?? null,
            'TrangThai' => 1,
            'IsDeleted' => 0,
            'NgayTao' => now(),
        ]);

        return redirect('/dang-nhap')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    public function doiMatKhau(Request $request)
    {
        $kh = session('khachhang');

        if (! $kh) {
            return redirect('/dang-nhap');
        }

        $khDb = DB::table('KhachHang')
            ->where('MaKH', $kh['MaKH'])
            ->first();

        if (! Hash::check($request->MatKhauCu, $khDb->MatKhau)) {
            return back();
        }

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

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'Đăng nhập thành công!');
        }

        throw ValidationException::withMessages([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ]);
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được vượt quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng khớp',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Đăng ký thành công! Chào mừng ' . $validated['name']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Đã đăng xuất');
    }
}
