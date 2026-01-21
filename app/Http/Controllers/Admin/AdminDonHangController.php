<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;

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

    // Cập nhật trạng thái
    public function updateStatus(Request $request, $id)
    {
        $donHang = DonHang::where('MaDH', $id)->firstOrFail();

        // Không cho đổi nếu đã hủy
        if ($donHang->TrangThai == 3) {
            return back()->with('error', 'Đơn hàng đã bị hủy');
        }

        // Không cho quay lùi trạng thái
        if ($request->TrangThai < $donHang->TrangThai) {
            return back()->with('error', 'Không thể quay lùi trạng thái');
        }

        $donHang->TrangThai = $request->TrangThai;
        $donHang->save();

        return back()->with('success', 'Cập nhật trạng thái thành công');
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

        // Chỉ cho hủy khi đang chờ xác nhận
        if ($donHang->TrangThai != 0) {
            return back()->with('error', 'Không thể hủy đơn hàng này');
        }

        $donHang->TrangThai = 3; // 3 = Đã hủy
        $donHang->save();

        return redirect()
            ->route('admin.donhang.index')
            ->with('success', 'Đã hủy đơn hàng thành công');
    }
}