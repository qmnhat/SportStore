<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhaCungCap;
class AdminNhaCungCapController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = NhaCungCap::query();

        // Tìm kiếm
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('TenNCC', 'like', '%' . $request->q . '%')
                    ->orWhere('Email', 'like', '%' . $request->q . '%');
            });
        }

        // Lọc trạng thái
        if ($request->filled('status')) {
            $query->where('TrangThai', $request->status);
        }

        // Sắp xếp
        if ($request->sort == 'asc') {
            $query->orderBy('MaNCC', 'asc');
        } else {
            $query->orderBy('MaNCC', 'desc');
        }

        $activeNCC = (clone $query)->where('IsDeleted', false)->paginate(10, ['*'], 'active_page');
        $deletedNCC = (clone $query)->where('IsDeleted', true)->paginate(10, ['*'], 'deleted_page');

        return view('admin.nha-cung-cap.index', compact('activeNCC', 'deletedNCC'));
    }

    public function create()
    {
        return view('admin.nha-cung-cap.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'TenNCC' => 'required|max:200',
            'Email' => 'nullable|email|max:150',
            'SDT' => 'nullable|max:15',
        ]);

        NhaCungCap::create([
            'TenNCC' => $request->TenNCC,
            'DiaChi' => $request->DiaChi,
            'SDT' => $request->SDT,
            'Email' => $request->Email,
            'TrangThai' => $request->TrangThai ?? 1,
            'NgayTao' => now(),
        ]);

        return redirect()->route('admin.nhacungcap.index')->with('success', 'Thêm nhà cung cấp thành công!');
    }

    public function edit($id)
    {
        $nhaCungCap = NhaCungCap::findOrFail($id);
        return view('admin.nha-cung-cap.edit', compact('nhaCungCap'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TenNCC' => 'required|max:200',
            'Email' => 'nullable|email|max:150',
            'SDT' => 'nullable|max:15',
        ]);

        $nhaCungCap = NhaCungCap::findOrFail($id);
        $nhaCungCap->update([
            'TenNCC' => $request->TenNCC,
            'DiaChi' => $request->DiaChi,
            'SDT' => $request->SDT,
            'Email' => $request->Email,
            'TrangThai' => $request->TrangThai ?? 1,
        ]);

        return redirect()->route('admin.nhacungcap.index')->with('success', 'Cập nhật nhà cung cấp thành công!');
    }

    public function destroy($id)
    {
        $nhaCungCap = NhaCungCap::findOrFail($id);
        $nhaCungCap->IsDeleted = true;
        $nhaCungCap->DeletedAt = now();
        $nhaCungCap->save();

        return redirect()->route('admin.nhacungcap.index')->with('success', 'Xóa nhà cung cấp thành công!');
    }

    public function restore($id)
    {
        $nhaCungCap = NhaCungCap::findOrFail($id);
        $nhaCungCap->IsDeleted = false;
        $nhaCungCap->DeletedAt = null;
        $nhaCungCap->save();

        return redirect()->route('admin.nhacungcap.index')->with('success', 'Khôi phục nhà cung cấp thành công!');
    }
}
