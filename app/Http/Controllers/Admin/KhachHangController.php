<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class KhachHangController extends Controller
{
    public function create()
    {
        return view('admin.khachhang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'HoTen'   => 'required|string|max:120',
            'Email'   => 'required|email|unique:KhachHang,Email',
            'GioiTinh' => 'nullable|in:0,1',
            'MatKhau' => 'required|min:6|confirmed',
            'SDT'     => 'nullable|string|max:20',
            'DiaChi'  => 'nullable|string|max:255',
            'NgaySinh' => 'nullable|date',
        ]);

        KhachHang::create([
            'HoTen'     => $request->HoTen,
            'Email'     => $request->Email,
            'MatKhau'   => Hash::make($request->MatKhau), // ⚠️ bắt buộc hash
            'SDT'       => $request->SDT,
            'DiaChi'    => $request->DiaChi,
            'GioiTinh' => $request->GioiTinh,
            'NgaySinh'  => $request->NgaySinh,
            'TrangThai' => 1,
            'IsDeleted' => 0,
            'NgayTao'   => Carbon::now(),
        ]);

        return redirect()
            ->route('admin.khachhang.index')
            ->with('success', 'Thêm khách hàng thành công');
    }
    /**
     * Hiển thị danh sách khách hàng
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $status = $request->input('status');
        $sort = $request->input('sort', 'desc'); // 'asc' hoặc 'desc'

        // Khách hàng đang hoạt động
        $activeKH = KhachHang::where('IsDeleted', false)
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('HoTen', 'like', "%$q%")
                        ->orWhere('Email', 'like', "%$q%");
                });
            })
            ->when(isset($status), function ($query) use ($status) {
                $query->where('TrangThai', $status);
            })
            ->orderBy('NgayTao', $sort)
            ->paginate(10, ['*'], 'active_page') // phân trang riêng cho tab active
            ->withQueryString(); // giữ query string khi phân trang

        // Khách hàng đã xóa
        $deletedKH = KhachHang::where('IsDeleted', true)
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('HoTen', 'like', "%$q%")
                        ->orWhere('Email', 'like', "%$q%");
                });
            })
            ->when(isset($status), function ($query) use ($status) {
                $query->where('TrangThai', $status);
            })
            ->orderBy('NgayTao', $sort)
            ->paginate(10, ['*'], 'deleted_page') // phân trang riêng cho tab deleted
            ->withQueryString();

        return view('admin.khachhang.index', compact('activeKH', 'deletedKH', 'sort'));
    }


    /**
     * Xóa mềm khách hàng
     */
    public function destroy($id)
    {
        $kh = KhachHang::findOrFail($id);
        $kh->IsDeleted = true;
        $kh->DeletedAt = now();
        $kh->save();

        return redirect()->back()->with('success', 'Khách hàng đã được xóa.');
    }

    /**
     * Khôi phục khách hàng đã xóa
     */
    public function restore($id)
    {
        $kh = KhachHang::findOrFail($id);
        $kh->IsDeleted = false;
        $kh->DeletedAt = null;
        $kh->save();

        return redirect()->back()->with('success', 'Khách hàng đã được khôi phục.');
    }
    // Hiển thị form sửa
    public function edit($id)
    {
        $kh = KhachHang::findOrFail($id);
        return view('admin.khachhang.edit', compact('kh'));
    }

    // Cập nhật thông tin
    public function update(Request $request, $id)
    {
        $request->validate([
            'HoTen' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'DiaChi' => 'nullable|string|max:255',
            'GioiTinh' => 'nullable|in:0,1',
            'SDT' => 'nullable|string|max:20',
            'NgaySinh' => 'nullable|date',
            'TrangThai' => 'required|boolean',
        ]);

        $kh = KhachHang::findOrFail($id);
        $kh->update([
            'HoTen'      => $request->HoTen,
            'Email'      => $request->Email,
            'DiaChi'     => $request->DiaChi,
            'SDT'        => $request->SDT,
            'NgaySinh'   => $request->NgaySinh,
            'GioiTinh'   => $request->GioiTinh, // ✅ BỔ SUNG
            'TrangThai'  => $request->TrangThai,
        ]);


        return redirect()->route('admin.khachhang.index')->with('success', 'Cập nhật khách hàng thành công!');
    }
    public function thongTinCaNhan()
{
    $kh = KhachHang::find(session('MaKH'));
 // hoặc lấy theo session MaKH

    $sanPhamYeuThich = $kh->yeuThich()->get();

    return view('khachhang.thongtincanhan', compact('kh', 'sanPhamYeuThich'));
}

}
