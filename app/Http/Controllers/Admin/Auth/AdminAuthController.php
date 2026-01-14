<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt([
            'Email' => $request->email,
            'password' => $request->password,
            'TrangThai' => 1,
        ])) {

            $request->session()->regenerate();

            $user = Auth::guard('admin')->user();

            // Phân quyền
            if ($user->VaiTro == 1) {
                return redirect('/admin/dashboard');
            }

            if ($user->VaiTro == 2) {
                return redirect('/manager/dashboard');
            }

            Auth::guard('admin')->logout();
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
