<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminDanhMucController extends Controller
{
    /**
     * Hiển thị danh sách danh mục
     */
    public function index(Request $request)
    {
        $activeDM = DanhMuc::where('IsDeleted', false)->paginate(10);
        $deletedDM = DanhMuc::where('IsDeleted', true)->paginate(10);

        return view('admin.danh-muc.index', compact('activeDM', 'deletedDM'));
    }

    /**
     * Form tạo danh mục
     */
    public function create()
    {
        return view('admin.danh-muc.create');
    }

    /**
     * Lưu danh mục mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenDM' => 'required|string|max:100|unique:DanhMuc,TenDM',
            'MoTa' => 'nullable|string',
        ]);

        DanhMuc::create([
            'TenDM' => $request->TenDM,
            'MoTa' => $request->MoTa,
        ]);

        return redirect()->route('admin.danhmuc.index')->with('success', 'Thêm danh mục thành công!');
    }

    /**
     * Form sửa danh mục
     */
    public function edit($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        return view('admin.danh-muc.edit', compact('danhMuc'));
    }

    /**
     * Cập nhật danh mục
     */
    public function update(Request $request, $id)
    {
        $danhMuc = DanhMuc::findOrFail($id);

        $request->validate([
            'TenDM' => 'required|string|max:100|unique:DanhMuc,TenDM,' . $danhMuc->MaDM . ',MaDM',
            'MoTa' => 'nullable|string',
        ]);

        $danhMuc->update([
            'TenDM' => $request->TenDM,
            'MoTa' => $request->MoTa,
        ]);

        return redirect()->route('admin.danhmuc.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    /**
     * Xóa mềm (soft delete)
     */
    public function destroy($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->update([
            'IsDeleted' => true,
            'DeletedAt' => now(),
        ]);

        return redirect()->back()->with('success', 'Xóa danh mục thành công!');
    }

    /**
     * Khôi phục danh mục
     */
    public function restore($id)
    {
        $danhMuc = DanhMuc::findOrFail($id);
        $danhMuc->update([
            'IsDeleted' => false,
            'DeletedAt' => null,
        ]);

        return redirect()->back()->with('success', 'Khôi phục danh mục thành công!');
    }
}
