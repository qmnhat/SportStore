<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
class AdminSanPhamController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = SanPham::with(['danhMuc', 'thuongHieu']);

        // Tìm kiếm
        if ($request->filled('q')) {
            $query->where('TenSP', 'like', '%' . $request->q . '%');
        }

        // Sắp xếp
        if ($request->sort === 'asc') {
            $query->orderBy('MaSP', 'asc');
        } else {
            $query->orderBy('MaSP', 'desc');
        }

        $activeSP = (clone $query)
            ->where('IsDeleted', false)
            ->paginate(10, ['*'], 'active_page');

        $deletedSP = (clone $query)
            ->where('IsDeleted', true)
            ->paginate(10, ['*'], 'deleted_page');

        return view('admin.sanpham.index', compact('activeSP', 'deletedSP'));
    }
    public function create()
    {
        $danhMucs = DanhMuc::where('IsDeleted', false)->get();
        $thuongHieus = ThuongHieu::where('IsDeleted', false)->get();
        return view('admin.sanpham.create', compact('danhMucs', 'thuongHieus'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'TenSP' => 'required|max:100',
            'MaDM' => 'required|exists:DanhMuc,MaDM',
            'MaTH' => 'required|exists:ThuongHieu,MaTH',
        ]);

        SanPham::create([
            'TenSP' => $request->TenSP,
            'MaDM' => $request->MaDM,
            'MaTH' => $request->MaTH,
            'MoTa' => $request->MoTa,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()->route('admin.sanpham.index');
    }
    public function edit($id){
        $sanpham = SanPham::findOrFail($id);
        $danhMucs = DanhMuc::where('IsDeleted', false)->get();
        $thuongHieus = ThuongHieu::where('IsDeleted', false)->get();
        return view('admin.sanpham.edit', compact('sanpham', 'danhMucs', 'thuongHieus'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'TenSP' => 'required|max:100',
            'MaDM' => 'required|exists:DanhMuc,MaDM',
            'MaTH' => 'required|exists:ThuongHieu,MaTH',
        ]);

        $sanpham = SanPham::findOrFail($id);
        $sanpham->update([
            'TenSP' => $request->TenSP,
            'MaDM' => $request->MaDM,
            'MaTH' => $request->MaTH,
            'MoTa' => $request->MoTa,
            'TrangThai' => $request->TrangThai,
        ]);

        return redirect()->route('admin.sanpham.index');
    }
    public function destroy($id){
        SanPham::where('MaSP', $id)->update([
            'IsDeleted' => true,
            'DeletedAt' => now(),
        ]);
        return redirect()->back();
    }
    public function restore($id){
        SanPham::where('MaSP', $id)->update([
            'IsDeleted' => false,
            'DeletedAt' => null,
        ]);
        return redirect()->back();
    }
}
