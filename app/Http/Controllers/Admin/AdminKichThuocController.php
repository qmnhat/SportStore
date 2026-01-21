<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KichThuoc;
use Illuminate\Http\Request;

class AdminKichThuocController extends Controller
{
    /**
     * Hiển thị danh sách kích thước
     */
    public function index()
    {
        $kichThuocs = KichThuoc::orderBy('MaKT', 'asc')->paginate(15);
        return view('admin.kich-thuoc.index', compact('kichThuocs'));
    }

    /**
     * Hiển thị form thêm kích thước
     */
    public function create()
    {
        return view('admin.kich-thuoc.create');
    }

    /**
     * Lưu kích thước mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenKT' => 'required|string|max:50|unique:KichThuoc,TenKT',
        ], [
            'TenKT.required' => 'Vui lòng nhập tên kích thước',
            'TenKT.max' => 'Tên kích thước không quá 50 ký tự',
            'TenKT.unique' => 'Kích thước này đã tồn tại',
        ]);

        KichThuoc::create([
            'TenKT' => $request->TenKT,
        ]);

        return redirect()->route('admin.kichthuoc.index')
            ->with('success', 'Thêm kích thước thành công!');
    }

    /**
     * Hiển thị form sửa kích thước
     */
    public function edit($id)
    {
        $kichThuoc = KichThuoc::findOrFail($id);
        return view('admin.kich-thuoc.edit', compact('kichThuoc'));
    }

    /**
     * Cập nhật kích thước
     */
    public function update(Request $request, $id)
    {
        $kichThuoc = KichThuoc::findOrFail($id);

        $request->validate([
            'TenKT' => 'required|string|max:50|unique:KichThuoc,TenKT,' . $id . ',MaKT',
        ], [
            'TenKT.required' => 'Vui lòng nhập tên kích thước',
            'TenKT.max' => 'Tên kích thước không quá 50 ký tự',
            'TenKT.unique' => 'Kích thước này đã tồn tại',
        ]);

        $kichThuoc->update([
            'TenKT' => $request->TenKT,
        ]);

        return redirect()->route('admin.kichthuoc.index')
            ->with('success', 'Cập nhật kích thước thành công!');
    }

    /**
     * Xóa kích thước
     */
    public function destroy($id)
    {
        $kichThuoc = KichThuoc::findOrFail($id);

        // Kiểm tra xem kích thước có đang được sử dụng không
        if ($kichThuoc->bienThes()->count() > 0) {
            return redirect()->route('admin.kichthuoc.index')
                ->with('error', 'Không thể xóa kích thước đang được sử dụng bởi sản phẩm!');
        }

        $kichThuoc->delete();

        return redirect()->route('admin.kichthuoc.index')
            ->with('success', 'Xóa kích thước thành công!');
    }
}
