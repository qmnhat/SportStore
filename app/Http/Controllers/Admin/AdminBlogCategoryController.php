<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class AdminBlogCategoryController extends Controller
{
    /**
     * Danh sách danh mục
     */
    public function index(Request $request)
    {
        $query = BlogCategory::withCount('posts');

        if ($request->filled('q')) {
            $query->where('TenDanhMuc', 'like', '%' . $request->q . '%');
        }

        $categories = $query->latest()->paginate(15);
        return view('admin.blog-category.index', compact('categories'));
    }

    /**
     * Tạo danh mục mới
     */
    public function create()
    {
        return view('admin.blog-category.create');
    }

    /**
     * Lưu danh mục mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'TenDanhMuc' => 'required|string|max:200|unique:blog_categories,TenDanhMuc',
            'MoTa' => 'nullable|string',
            'TrangThai' => 'required|in:0,1',
        ]);

        BlogCategory::create($validated);
        return redirect()->route('admin.blog-category.index')->with('success', 'Tạo danh mục thành công!');
    }

    /**
     * Chỉnh sửa danh mục
     */
    public function edit(BlogCategory $blogCategory)
    {
        return view('admin.blog-category.edit', compact('blogCategory'));
    }

    /**
     * Cập nhật danh mục
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validated = $request->validate([
            'TenDanhMuc' => 'required|string|max:200|unique:blog_categories,TenDanhMuc,' . $blogCategory->id,
            'MoTa' => 'nullable|string',
            'TrangThai' => 'required|in:0,1',
        ]);

        $blogCategory->update($validated);
        return redirect()->route('admin.blog-category.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    /**
     * Xóa danh mục
     */
    public function destroy(BlogCategory $blogCategory)
    {
        $blogCategory->delete();
        return redirect()->route('admin.blog-category.index')->with('success', 'Xóa danh mục thành công!');
    }
}
