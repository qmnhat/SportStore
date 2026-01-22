<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhieuNhap;
use App\Models\ChiTietPhieuNhap;
use App\Models\NhaCungCap;
use App\Models\BienTheSanPham;
use App\Models\SanPham;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminKhoController extends Controller
{
    //
    /**
     * Trang chính Quản lý Kho - Hiển thị tồn kho
     */
    public function index(Request $request)
    {
        $query = BienTheSanPham::with(['sanPham', 'kichThuoc'])
            ->where('IsDeleted', false);

        // Tìm kiếm theo tên sản phẩm
        if ($request->filled('q')) {
            $query->whereHas('sanPham', function ($q) use ($request) {
                $q->where('TenSP', 'like', '%' . $request->q . '%');
            });
        }

        // Lọc theo trạng thái tồn kho
        if ($request->filled('stock')) {
            if ($request->stock == 'low') {
                $query->where('SoLuong', '<=', 10)->where('SoLuong', '>', 0);
            } elseif ($request->stock == 'out') {
                $query->where('SoLuong', '<=', 0);
            } elseif ($request->stock == 'available') {
                $query->where('SoLuong', '>', 10);
            }
        }

        // Sắp xếp
        if ($request->sort == 'stock_asc') {
            $query->orderBy('SoLuong', 'asc');
        } elseif ($request->sort == 'stock_desc') {
            $query->orderBy('SoLuong', 'desc');
        } else {
            $query->orderBy('MaBT', 'desc');
        }

        $tonKho = $query->paginate(15);

        // Thống kê
        $thongKe = [
            'tongSanPham' => BienTheSanPham::where('IsDeleted', false)->count(),
            'sapHet' => BienTheSanPham::where('IsDeleted', false)->where('SoLuong', '<=', 10)->where('SoLuong', '>', 0)->count(),
            'hetHang' => BienTheSanPham::where('IsDeleted', false)->where('SoLuong', '<=', 0)->count(),
            'tongTonKho' => BienTheSanPham::where('IsDeleted', false)->sum('SoLuong'),
        ];

        return view('admin.kho.index', compact('tonKho', 'thongKe'));
    }

    /**
     * Danh sách Phiếu Nhập Kho
     */
    public function phieuNhapIndex(Request $request)
    {
        $query = PhieuNhap::with(['nhaCungCap', 'nhaQuanLy', 'chiTiet']);

        // Tìm kiếm
        if ($request->filled('q')) {
            $query->where('MaPN', 'like', '%' . $request->q . '%')
                ->orWhereHas('nhaCungCap', function ($q) use ($request) {
                    $q->where('TenNCC', 'like', '%' . $request->q . '%');
                });
        }

        // Lọc trạng thái
        if ($request->filled('status')) {
            $query->where('TrangThai', $request->status);
        }

        // Sắp xếp
        $query->orderBy('NgayNhap', 'desc');

        $activePN = (clone $query)->where('IsDeleted', false)->paginate(10, ['*'], 'active_page');
        $deletedPN = (clone $query)->where('IsDeleted', true)->paginate(10, ['*'], 'deleted_page');

        return view('admin.kho.phieu-nhap.index', compact('activePN', 'deletedPN'));
    }

    /**
     * Form tạo Phiếu Nhập mới
     */
    public function phieuNhapCreate()
    {
        $nhaCungCaps = NhaCungCap::where('IsDeleted', false)
            ->where('TrangThai', 1)
            ->get();

        $sanPhams = SanPham::with(['bienThe.kichThuoc'])
            ->where('IsDeleted', false)
            ->where('TrangThai', 1)
            ->get();

        return view('admin.kho.phieu-nhap.create', compact('nhaCungCaps', 'sanPhams'));
    }

    /**
     * Lưu Phiếu Nhập mới
     */
    public function phieuNhapStore(Request $request)
    {
        $request->validate([
            'MaNCC' => 'required|exists:NhaCungCap,MaNCC',
            'chitiet' => 'required|array|min:1',
            'chitiet.*.MaBT' => 'required|exists:BienTheSanPham,MaBT',
            'chitiet.*.SoLuong' => 'required|integer|min:1',
            'chitiet.*.GiaNhap' => 'required|numeric|min:0',
        ], [
            'chitiet.required' => 'Vui lòng thêm ít nhất 1 sản phẩm vào phiếu nhập.',
            'chitiet.min' => 'Vui lòng thêm ít nhất 1 sản phẩm vào phiếu nhập.',
        ]);

        DB::beginTransaction();
        try {
            // Tạo phiếu nhập
            $phieuNhap = PhieuNhap::create([
                'MaQL' => Auth::guard('admin')->user()->MaQL,
                'MaNCC' => $request->MaNCC,
                'NgayNhap' => now(),
                'GhiChu' => $request->GhiChu,
                'TrangThai' => 0, // Chờ duyệt
            ]);

            // Tạo chi tiết phiếu nhập
            foreach ($request->chitiet as $ct) {
                if (!empty($ct['MaBT']) && !empty($ct['SoLuong']) && isset($ct['GiaNhap'])) {
                    ChiTietPhieuNhap::create([
                        'MaPN' => $phieuNhap->MaPN,
                        'MaBT' => $ct['MaBT'],
                        'SoLuong' => $ct['SoLuong'],
                        'GiaNhap' => $ct['GiaNhap'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.kho.phieu-nhap.index')
                ->with('success', 'Tạo phiếu nhập thành công! Đang chờ duyệt.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Xem chi tiết Phiếu Nhập
     */
    public function phieuNhapShow($id)
    {
        $phieuNhap = PhieuNhap::with(['nhaCungCap', 'nhaQuanLy', 'chiTiet.bienThe.sanPham', 'chiTiet.bienThe.kichThuoc'])
            ->findOrFail($id);

        return view('admin.kho.phieu-nhap.show', compact('phieuNhap'));
    }

    /**
     * Duyệt Phiếu Nhập - Cộng tồn kho
     */
    public function phieuNhapApprove($id)
    {
        DB::beginTransaction();
        try {
            $phieuNhap = PhieuNhap::with('chiTiet')->findOrFail($id);

            if ($phieuNhap->TrangThai != 0) {
                return back()->with('error', 'Phiếu nhập này đã được xử lý!');
            }

            // Cộng tồn kho cho từng biến thể
            foreach ($phieuNhap->chiTiet as $ct) {
                $bienThe = BienTheSanPham::find($ct->MaBT);
                if ($bienThe) {
                    $bienThe->SoLuong += $ct->SoLuong;
                    $bienThe->save();
                }
            }

            // Cập nhật trạng thái phiếu nhập
            $phieuNhap->TrangThai = 1; // Đã duyệt
            $phieuNhap->save();

            DB::commit();
            return back()->with('success', 'Duyệt phiếu nhập thành công! Đã cộng tồn kho.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Hủy Phiếu Nhập
     */
    public function phieuNhapCancel($id)
    {
        $phieuNhap = PhieuNhap::findOrFail($id);

        if ($phieuNhap->TrangThai == 1) {
            return back()->with('error', 'Không thể hủy phiếu nhập đã duyệt!');
        }

        $phieuNhap->TrangThai = 2; // Hủy
        $phieuNhap->save();

        return back()->with('success', 'Đã hủy phiếu nhập.');
    }

    /**
     * Xóa mềm Phiếu Nhập
     */
    public function phieuNhapDestroy($id)
    {
        $phieuNhap = PhieuNhap::findOrFail($id);

        if ($phieuNhap->TrangThai == 1) {
            return back()->with('error', 'Không thể xóa phiếu nhập đã duyệt!');
        }

        $phieuNhap->IsDeleted = true;
        $phieuNhap->DeletedAt = now();
        $phieuNhap->save();

        return back()->with('success', 'Đã xóa phiếu nhập.');
    }

    /**
     * Khôi phục Phiếu Nhập
     */
    public function phieuNhapRestore($id)
    {
        $phieuNhap = PhieuNhap::findOrFail($id);
        $phieuNhap->IsDeleted = false;
        $phieuNhap->DeletedAt = null;
        $phieuNhap->save();

        return back()->with('success', 'Đã khôi phục phiếu nhập.');
    }

    /**
     * Cập nhật nhanh tồn kho (điều chỉnh thủ công)
     */
    public function updateStock(Request $request, $maBT)
    {
        $request->validate([
            'SoLuong' => 'required|integer|min:0',
        ]);

        $bienThe = BienTheSanPham::findOrFail($maBT);
        $bienThe->SoLuong = $request->SoLuong;
        $bienThe->save();

        return back()->with('success', 'Cập nhật tồn kho thành công!');
    }
}
