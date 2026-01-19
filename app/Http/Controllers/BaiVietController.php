<?php

namespace App\Http\Controllers;

use App\Models\BaiViet;
use Illuminate\Http\Request;

class BaiVietController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = BaiViet::query();
        // Tìm kiếm
        if ($request->filled('q')) {
            $query->where('TieuDe', 'like', '%' . $request->q . '%')
                  ->orWhere('NoiDung', 'like', '%' . $request->q . '%')
                  ->orWhere('TomTat', 'like', '%' . $request->q . '%');
        }
        //chi lấy bài viết công khai
        $query->where('TrangThai', 1)->where('IsDeleted', false);

        // Sắp xếp
        $baiviet = $query->orderBy('NgayTao', 'desc')->paginate(9);

        return view('pages.bai-viet.index', compact('baiviet'));
    }

    public function show($slug)
    {
        $baiViet = BaiViet::where('slug', $slug)
            ->where('TrangThai', 1)
            ->where('IsDeleted', false)
            ->firstOrFail();

        // Lấy bài viết liên quan (cùng tên tác giả, loại trừ bài hiện tại)
        $relatedPosts = BaiViet::where('NguoiTao', $baiViet->NguoiTao)
            ->where('MaBV', '!=', $baiViet->MaBV)
            ->where('TrangThai', 1)
            ->where('IsDeleted', false)
            ->orderBy('NgayTao', 'desc')
            ->limit(2)
            ->get();

        // Nếu không đủ bài liên quan, lấy thêm từ bài viết mới nhất
        if ($relatedPosts->count() < 2) {
            $remaining = 2 - $relatedPosts->count();
            $morePosts = BaiViet::where('MaBV', '!=', $baiViet->MaBV)
                ->where('TrangThai', 1)
                ->where('IsDeleted', false)
                ->whereNotIn('MaBV', $relatedPosts->pluck('MaBV'))
                ->orderBy('NgayTao', 'desc')
                ->limit($remaining)
                ->get();
            $relatedPosts = $relatedPosts->merge($morePosts);
        }

        // Lấy 5 bài viết mới nhất cho sidebar
        $latestPosts = BaiViet::where('MaBV', '!=', $baiViet->MaBV)
            ->where('TrangThai', 1)
            ->where('IsDeleted', false)
            ->orderBy('NgayTao', 'desc')
            ->limit(5)
            ->get();

        return view('pages.bai-viet.show', compact('baiViet', 'relatedPosts', 'latestPosts'));
    }
}
