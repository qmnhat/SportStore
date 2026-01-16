<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhuyenMai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    // ==============================
    // DANH SÁCH + SEARCH + FILTER
    // ==============================

    public function index(Request $request)
    {
        // ACTIVE
        $activeQuery = KhuyenMai::where('IsDeleted', false);

        if ($request->q) {
            $activeQuery->where('TenKM', 'like', '%' . $request->q . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $activeQuery->where('TrangThai', $request->status);
        }

        $sort = $request->get('sort', 'desc');

        $activeQuery->orderBy('MaKM', $sort);

        $activeKM = $activeQuery->paginate(10);


        // DELETED
        $deletedKM = KhuyenMai::where('IsDeleted', true)
            ->orderBy('DeletedAt', 'desc')
            ->paginate(10);

        return view('admin.khuyenmai.index', compact('activeKM', 'deletedKM'));
    }


    // ==============================
    // FORM THÊM
    // ==============================

    public function create()
    {
        return view('admin.khuyenmai.create');
    }

    // ==============================
    // LƯU KHUYẾN MÃI
    // ==============================

    public function store(Request $request)
    {
        $request->validate([
            'TenKM' => 'required|max:150',
            'PhanTramGiam' => 'required|integer|min:1|max:100',
            'NgayBatDau' => 'required|date',
            'NgayKetThuc' => 'required|date|after_or_equal:NgayBatDau',
            'TrangThai' => 'required|boolean'
        ]);

        KhuyenMai::create([
            'TenKM' => $request->TenKM,
            'PhanTramGiam' => $request->PhanTramGiam,
            'NgayBatDau' => $request->NgayBatDau,
            'NgayKetThuc' => $request->NgayKetThuc,
            'TrangThai' => $request->TrangThai,
            'IsDeleted' => false
        ]);

        return redirect()
            ->route('admin.khuyenmai.index')
            ->with('success', 'Thêm khuyến mãi thành công');
    }

    // ==============================
    // FORM SỬA
    // ==============================

    public function edit($id)
    {
        $km = KhuyenMai::where('MaKM', $id)->firstOrFail();

        return view('admin.khuyenmai.edit', compact('km'));
    }

    // ==============================
    // CẬP NHẬT
    // ==============================

    public function update(Request $request, $id)
    {
        $km = KhuyenMai::where('MaKM', $id)->firstOrFail();

        $request->validate([
            'TenKM' => 'required|max:150',
            'PhanTramGiam' => 'required|integer|min:1|max:100',
            'NgayBatDau' => 'required|date',
            'NgayKetThuc' => 'required|date|after_or_equal:NgayBatDau',
            'TrangThai' => 'required|boolean'
        ]);

        $km->update([
            'TenKM' => $request->TenKM,
            'PhanTramGiam' => $request->PhanTramGiam,
            'NgayBatDau' => $request->NgayBatDau,
            'NgayKetThuc' => $request->NgayKetThuc,
            'TrangThai' => $request->TrangThai
        ]);

        return redirect()
            ->route('admin.khuyenmai.index')
            ->with('success', 'Cập nhật khuyến mãi thành công');
    }

    // ==============================
    // SOFT DELETE
    // ==============================

    public function destroy($id)
    {
        $km = KhuyenMai::where('MaKM', $id)->firstOrFail();

        $km->update([
            'IsDeleted' => true,
            'DeletedAt' => now()
        ]);

        return redirect()
            ->route('admin.khuyenmai.index')
            ->with('success', 'Đã xóa khuyến mãi');
    }

    // ==============================
    // KHÔI PHỤC
    // ==============================

    public function restore($id)
    {
        $km = KhuyenMai::where('MaKM', $id)->firstOrFail();

        $km->update([
            'IsDeleted' => false,
            'DeletedAt' => null
        ]);

        return redirect()
            ->route('admin.khuyenmai.index')
            ->with('success', 'Khôi phục khuyến mãi thành công');
    }
}
