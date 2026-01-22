<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = BaiViet::active()->with('category');

        // Tìm kiếm
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Lọc theo danh mục
        if ($request->filled('category')) {
            $query->where('MaDanhMuc', $request->category);
        }

        $baiViets = $query->latest()->paginate(9);
        $categories = \App\Models\BlogCategory::active()->withCount('posts')->get();
        $allPostsCount = BaiViet::active()->count();

        return view('pages.bai-viet.index', compact('baiViets', 'categories', 'allPostsCount'));
    }

    public function show($slug)
    {
        $baiViet = BaiViet::where('slug', $slug)
            ->where('TrangThai', 1)
            ->with('author', 'category')
            ->firstOrFail();

        // Tăng lượt xem
        $baiViet->incrementView();

        // Lấy bài viết liên quan (cùng danh mục hoặc cùng tác giả)
        $relatedPosts = BaiViet::where('MaBV', '!=', $baiViet->MaBV)
            ->where('TrangThai', 1)
            ->where(function ($query) use ($baiViet) {
                $query->where('MaDanhMuc', $baiViet->MaDanhMuc)
                      ->orWhere('NguoiTao', $baiViet->NguoiTao);
            })
            ->latest()
            ->limit(3)
            ->get();

        // Lấy 5 bài viết mới nhất
        $latestPosts = BaiViet::where('MaBV', '!=', $baiViet->MaBV)
            ->where('TrangThai', 1)
            ->latest()
            ->limit(5)
            ->get();

        // Lấy danh mục với post count
        $categories = \App\Models\BlogCategory::active()->withCount('posts')->get();

        return view('pages.bai-viet.show', compact('baiViet', 'relatedPosts', 'latestPosts', 'categories'));
    }
}
