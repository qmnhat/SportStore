<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminBaiVietController extends Controller
{
    /**
     * Hiển thị danh sách bài viết
     */
    public function index(Request $request)
    {
        $query = BaiViet::with('author', 'category');

        // Tìm kiếm
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('TrangThai', $request->status);
        }

        // Lọc theo danh mục
        if ($request->filled('category')) {
            $query->where('MaDanhMuc', $request->category);
        }

        $baiViets = $query->latest()->paginate(15);
        $categories = BlogCategory::active()->get();

        return view('admin.bai-viet.index', compact('baiViets', 'categories'));
    }

    /**
     * Tạo bài viết mới
     */
    public function create()
    {
        $categories = BlogCategory::active()->get();
        return view('admin.bai-viet.create', compact('categories'));
    }

    /**
     * Lưu bài viết mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'TieuDe' => 'required|string|max:200|unique:BaiViet,TieuDe',
            'TomTat' => 'required|string|max:500',
            'NoiDung' => 'required|string',
            'MaDanhMuc' => 'nullable|exists:blog_categories,id',
            'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'TrangThai' => 'required|in:0,1',
        ]);

        // Upload hình ảnh
        if ($request->hasFile('HinhAnh')) {
            $file = $request->file('HinhAnh');
            $filename = time() . '_' . Str::slug($request->TieuDe) . '.' . $file->extension();
            $path = $file->storeAs('blog', $filename, 'public');
            // Lưu đường dẫn URL đúng: /storage/blog/filename
            $validated['HinhAnh'] = '/storage/' . $path;
        }

        $validated['NguoiTao'] = auth('admin')->id();

        BaiViet::create($validated);

        return redirect()->route('admin.bai-viet.index')->with('success', 'Tạo bài viết thành công!');
    }

    /**
     * Chỉnh sửa bài viết
     */
    public function edit($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        $categories = BlogCategory::active()->get();
        return view('admin.bai-viet.edit', compact('baiViet', 'categories'));
    }
    /**
     * Xem chi tiết bài viết
     */
    public function show($id)
    {
        $baiViet = BaiViet::with('author', 'category')->findOrFail($id);
        return view('admin.bai-viet.show', compact('baiViet'));
    }
    /**
     * Cập nhật bài viết
     */
    public function update(Request $request, $id)
    {
        $baiViet = BaiViet::findOrFail($id);

        $validated = $request->validate([
            'TieuDe' => 'required|string|max:200|unique:BaiViet,TieuDe,' . $baiViet->MaBV . ',MaBV',
            'TomTat' => 'required|string|max:500',
            'NoiDung' => 'required|string',
            'MaDanhMuc' => 'nullable|exists:blog_categories,id',
            'HinhAnh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'TrangThai' => 'required|in:0,1',
        ]);

        // Nếu checkbox xóa hình ảnh được chọn
        if ($request->has('delete_image') && $request->delete_image == 1) {
            if ($baiViet->HinhAnh) {
                $oldImagePath = str_replace('/storage/', '', $baiViet->HinhAnh);
                Storage::disk('public')->delete($oldImagePath);
                $validated['HinhAnh'] = null;
            }
        }

        // Xóa hình cũ nếu upload hình mới
        if ($request->hasFile('HinhAnh')) {
            if ($baiViet->HinhAnh) {
                // Xóa tập tin cũ
                $oldImagePath = str_replace('/storage/', '', $baiViet->HinhAnh);
                Storage::disk('public')->delete($oldImagePath);
            }

            $file = $request->file('HinhAnh');
            $filename = time() . '_' . Str::slug($request->TieuDe) . '.' . $file->extension();
            $path = $file->storeAs('blog', $filename, 'public');
            // Lưu đường dẫn URL đúng: /storage/blog/filename
            $validated['HinhAnh'] = '/storage/' . $path;
        }

        $baiViet->update($validated);

        return redirect()->route('admin.bai-viet.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    /**
     * Xóa bài viết (soft delete)
     */
    public function destroy($id)
    {
        $baiViet = BaiViet::findOrFail($id);
        $baiViet->delete();
        return redirect()->route('admin.bai-viet.index')->with('success', 'Xóa bài viết thành công!');
    }

    /**
     * Xóa vĩnh viễn
     */
    public function forceDelete($id)
    {
        $baiViet = BaiViet::withTrashed()->findOrFail($id);

        if ($baiViet->HinhAnh) {
            // Xóa tập tin hình ảnh
            $imagePath = str_replace('/storage/', '', $baiViet->HinhAnh);
            Storage::disk('public')->delete($imagePath);
        }

        $baiViet->forceDelete();
        return redirect()->route('admin.bai-viet.index')->with('success', 'Xóa vĩnh viễn bài viết thành công!');
    }

    /**
     * Khôi phục bài viết (undo soft delete)
     */
    public function restore($id)
    {
        $baiViet = BaiViet::withTrashed()->findOrFail($id);
        $baiViet->restore();
        return redirect()->route('admin.bai-viet.index')->with('success', 'Khôi phục bài viết thành công!');
    }
}

