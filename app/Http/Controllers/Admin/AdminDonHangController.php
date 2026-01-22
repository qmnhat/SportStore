<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use App\Models\BienTheSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDonHangController extends Controller
{
    // Danh sách đơn hàng
    public function index(Request $request)
    {
        $query = DonHang::with('khachHang');

        if ($request->q) {
            $query->where('MaDH', 'like', '%' . trim($request->q, '#DH') . '%');
        }

        if ($request->status !== null && $request->status !== '') {
            $query->where('TrangThai', $request->status);
        }

        if ($request->sort === 'asc') {
            $query->orderBy('NgayDat', 'asc');
        } else {
            $query->orderBy('NgayDat', 'desc');
        }

        $donHangActive = (clone $query)
            ->where('TrangThai', '<>', 3)
            ->paginate(10);

        $donHangCancelled = DonHang::with('khachHang')
            ->where('TrangThai', 3)
            ->paginate(10);

        return view('admin.donhang.index', compact(
            'donHangActive',
            'donHangCancelled'
    ));
    }

    /**
     * Cập nhật trạng thái đơn hàng
     * 0: Chờ xác nhận
     * 1: Đang giao
     * 2: Hoàn thành (trừ kho khi sang trạng thái này)
     * 3: Đã hủy (hoàn trả kho)
     */
    public function updateStatus(Request $request, $id)
    {
        $donHang = DonHang::with('chiTiet')->where('MaDH', $id)->firstOrFail();
        $trangThaiCu = $donHang->TrangThai;
        $trangThaiMoi = (int)$request->TrangThai;

        // Không cho đổi nếu đã hủy
        if ($trangThaiCu == 3) {
            return back()->with('error', 'Đơn hàng đã bị hủy');
        }

        // Không cho quay lùi trạng thái
        if ($trangThaiMoi < $trangThaiCu) {
            return back()->with('error', 'Không thể quay lùi trạng thái');
        }

        DB::beginTransaction();
        try {
            // Nếu chuyển sang "Hoàn thành" (2) từ trạng thái khác
            if ($trangThaiMoi == 2 && $trangThaiCu != 2) {
                $this->giamTonKho($donHang);
            }

            // Nếu hủy đơn hàng - CHỈ hoàn kho nếu đơn đã ở trạng thái "Hoàn thành" (2)
            // vì chỉ khi hoàn thành mới trừ kho, nên chỉ hoàn kho khi hủy từ trạng thái đó
            if ($trangThaiMoi == 3 && $trangThaiCu == 2) {
                $this->hoantranTonKho($donHang);
            }

            $donHang->TrangThai = $trangThaiMoi;
            $donHang->save();

            DB::commit();
            return back()->with('success', 'Cập nhật trạng thái thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    /**
     * Giảm tồn kho khi đơn hàng hoàn thành
     */
    private function giamTonKho(DonHang $donHang)
    {
        $chiTiets = DB::table('ChiTietDonHang')
            ->where('MaDH', $donHang->MaDH)
            ->get();

        foreach ($chiTiets as $ct) {
            $bienThe = BienTheSanPham::find($ct->MaBT);
            if ($bienThe) {
                $bienThe->SoLuong -= $ct->SoLuong;
                if ($bienThe->SoLuong < 0) {
                    $bienThe->SoLuong = 0;
                }
                $bienThe->save();
            }
        }
    }

    /**
     * Hoàn trả tồn kho khi đơn hàng bị hủy
     */
    private function hoantranTonKho(DonHang $donHang)
    {
        $chiTiets = DB::table('ChiTietDonHang')
            ->where('MaDH', $donHang->MaDH)
            ->get();

        foreach ($chiTiets as $ct) {
            $bienThe = BienTheSanPham::find($ct->MaBT);
            if ($bienThe) {
                $bienThe->SoLuong += $ct->SoLuong;
                $bienThe->save();
            }
        }
    }

    // Xoá đơn hàng (soft delete)
    public function delete($id)
    {
        $donHang = DonHang::findOrFail($id);
        $donHang->IsDeleted = 1;
        $donHang->save();

        return back()->with('success', 'Đã xoá đơn hàng');
    }

    public function show($id)
    {
        $donHang = DonHang::with('khachHang')
            ->where('MaDH', $id)
            ->firstOrFail();

        return view('admin.donhang.show', compact('donHang'));
    }

    public function cancel($id)
    {
        $donHang = DonHang::where('MaDH', $id)->firstOrFail();
        $trangThaiCu = $donHang->TrangThai;

        // Không cho hủy nếu đã hủy rồi
        if ($trangThaiCu == 3) {
            return back()->with('error', 'Đơn hàng đã bị hủy');
        }

        DB::beginTransaction();
        try {
            // CHỈ hoàn trả kho nếu đơn đã ở trạng thái "Hoàn thành" (2)
            // vì chỉ khi hoàn thành mới trừ kho
            if ($trangThaiCu == 2) {
                $this->hoantranTonKho($donHang);
            }

            $donHang->TrangThai = 3; // 3 = Đã hủy
            $donHang->save();

            DB::commit();

            $message = 'Đã hủy đơn hàng thành công.';
            if ($trangThaiCu == 2) {
                $message .= ' Kho đã được hoàn trả.';
            }

            return redirect()
                ->route('admin.donhang.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
