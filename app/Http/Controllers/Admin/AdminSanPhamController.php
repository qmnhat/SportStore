<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use App\Models\KichThuoc;
use App\Models\BienTheSanPham;
use App\Models\HinhAnhSanPham;
use Illuminate\Support\Facades\DB;

class AdminSanPhamController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = SanPham::with(['danhMuc', 'thuongHieu', 'hinhAnh', 'bienThe']);

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
        $kichThuocs = KichThuoc::all();
        return view('admin.sanpham.create', compact('danhMucs', 'thuongHieus', 'kichThuocs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'TenSP' => 'required|max:200',
            'MaDM' => 'required|exists:DanhMuc,MaDM',
            'MaTH' => 'required|exists:ThuongHieu,MaTH',
            'HinhAnh' => 'nullable|array',
            'HinhAnh.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bienthe' => 'nullable|array',
            'bienthe.*.MaKT' => 'required|exists:KichThuoc,MaKT',
            'bienthe.*.GiaGoc' => 'required|numeric|min:0',
            'bienthe.*.SoLuong' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Tạo sản phẩm
            $sanPham = SanPham::create([
                'TenSP' => $request->TenSP,
                'MaDM' => $request->MaDM,
                'MaTH' => $request->MaTH,
                'MoTa' => $request->MoTa,
                'TrangThai' => $request->TrangThai ?? 1,
                'NoiBat' => $request->NoiBat ?? 0,
            ]);

            // Upload hình ảnh
            if ($request->hasFile('HinhAnh')) {
                foreach ($request->file('HinhAnh') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->extension();
                    $image->move(public_path('img/products'), $filename);

                    HinhAnhSanPham::create([
                        'MaSP' => $sanPham->MaSP,
                        'DuongDan' => 'img/products/' . $filename,
                    ]);
                }
            }

            // Tạo biến thể sản phẩm
            if ($request->filled('bienthe')) {
                // Loại bỏ các biến thể trùng lặp (cùng MaKT)
                $processedKichThuocs = [];

                foreach ($request->bienthe as $bt) {
                    if (!empty($bt['MaKT']) && isset($bt['GiaGoc']) && isset($bt['SoLuong'])) {
                        // Nếu kích thước này đã được xử lý, bỏ qua
                        if (in_array($bt['MaKT'], $processedKichThuocs)) {
                            continue;
                        }
                        $processedKichThuocs[] = $bt['MaKT'];

                        BienTheSanPham::create([
                            'MaSP' => $sanPham->MaSP,
                            'MaKT' => $bt['MaKT'],
                            'GiaGoc' => $bt['GiaGoc'],
                            'SoLuong' => $bt['SoLuong'],
                            'TrangThai' => 1,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.sanpham.index')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $sanpham = SanPham::with(['hinhAnh', 'bienThe.kichThuoc'])->findOrFail($id);
        $danhMucs = DanhMuc::where('IsDeleted', false)->get();
        $thuongHieus = ThuongHieu::where('IsDeleted', false)->get();
        $kichThuocs = KichThuoc::all();
        return view('admin.sanpham.edit', compact('sanpham', 'danhMucs', 'thuongHieus', 'kichThuocs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'TenSP' => 'required|max:200',
            'MaDM' => 'required|exists:DanhMuc,MaDM',
            'MaTH' => 'required|exists:ThuongHieu,MaTH',
            'HinhAnh' => 'nullable|array',
            'HinhAnh.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bienthe' => 'nullable|array',
        ]);

        DB::beginTransaction();
        try {
            $sanpham = SanPham::findOrFail($id);
            $sanpham->update([
                'TenSP' => $request->TenSP,
                'MaDM' => $request->MaDM,
                'MaTH' => $request->MaTH,
                'MoTa' => $request->MoTa,
                'TrangThai' => $request->TrangThai ?? 1,
                'NoiBat' => $request->NoiBat ?? 0,
            ]);

            // Xóa hình ảnh không còn giữ
            $keepImages = $request->input('keep_images', []);
            $currentImages = HinhAnhSanPham::where('MaSP', $sanpham->MaSP)->get();

            foreach ($currentImages as $hinh) {
                if (!in_array($hinh->MaHinh, $keepImages)) {
                    $path = public_path($hinh->DuongDan);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $hinh->delete();
                }
            }

            // Upload hình ảnh mới
            if ($request->hasFile('HinhAnh')) {
                foreach ($request->file('HinhAnh') as $image) {
                    $filename = time() . '_' . uniqid() . '.' . $image->extension();
                    $image->move(public_path('img/products'), $filename);

                    HinhAnhSanPham::create([
                        'MaSP' => $sanpham->MaSP,
                        'DuongDan' => 'img/products/' . $filename,
                    ]);
                }
            }

            // Cập nhật biến thể sản phẩm
            if ($request->filled('bienthe')) {
                // Lấy tất cả MaBT cũ của sản phẩm
                $oldBienThes = BienTheSanPham::where('MaSP', $sanpham->MaSP)->pluck('MaBT')->toArray();

                // Xóa tất cả items giỏ hàng liên quan đến các biến thể cũ trước
                if (!empty($oldBienThes)) {
                    DB::table('ChiTietGioHang')->whereIn('MaBT', $oldBienThes)->delete();
                }

                // Xóa biến thể cũ
                BienTheSanPham::where('MaSP', $sanpham->MaSP)->delete();

                // Loại bỏ các biến thể trùng lặp (cùng MaKT)
                $processedKichThuocs = [];
                $newBienThes = [];

                foreach ($request->bienthe as $bt) {
                    if (!empty($bt['MaKT']) && isset($bt['GiaGoc']) && isset($bt['SoLuong'])) {
                        // Nếu kích thước này đã được xử lý, bỏ qua
                        if (in_array($bt['MaKT'], $processedKichThuocs)) {
                            continue;
                        }
                        $processedKichThuocs[] = $bt['MaKT'];
                        $newBienThes[] = $bt;
                    }
                }

                // Thêm biến thể mới (không trùng lặp)
                foreach ($newBienThes as $bt) {
                    BienTheSanPham::create([
                        'MaSP' => $sanpham->MaSP,
                        'MaKT' => $bt['MaKT'],
                        'GiaGoc' => $bt['GiaGoc'],
                        'SoLuong' => $bt['SoLuong'],
                        'TrangThai' => $bt['TrangThai'] ?? 1,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.sanpham.index')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        // Lấy tất cả biến thể của sản phẩm
        $bienThes = BienTheSanPham::where('MaSP', $id)->pluck('MaBT')->toArray();

        // Xóa tất cả items giỏ hàng liên quan
        if (!empty($bienThes)) {
            DB::table('ChiTietGioHang')->whereIn('MaBT', $bienThes)->delete();
        }

        // Soft delete sản phẩm
        SanPham::where('MaSP', $id)->update([
            'IsDeleted' => true,
            'DeletedAt' => now(),
        ]);
        return redirect()->back()->with('success', 'Xóa sản phẩm thành công!');
    }

    public function restore($id)
    {
        SanPham::where('MaSP', $id)->update([
            'IsDeleted' => false,
            'DeletedAt' => null,
        ]);
        return redirect()->back()->with('success', 'Khôi phục sản phẩm thành công!');
    }
}
