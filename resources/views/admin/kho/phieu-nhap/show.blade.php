@extends('admin.layouts.app')

@section('title', 'Chi tiết phiếu nhập #' . $phieuNhap->MaPN)

@section('content')
<div class="page-heading mb-4">
    <h3>Chi tiết Phiếu nhập #{{ $phieuNhap->MaPN }}</h3>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thông tin phiếu nhập</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Mã phiếu:</th>
                        <td><strong>#{{ $phieuNhap->MaPN }}</strong></td>
                    </tr>
                    <tr>
                        <th>Nhà cung cấp:</th>
                        <td>{{ $phieuNhap->nhaCungCap->TenNCC ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Ngày nhập:</th>
                        <td>{{ $phieuNhap->NgayNhap->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Người tạo:</th>
                        <td>{{ $phieuNhap->nhaQuanLy->HoTen ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái:</th>
                        <td>
                            @if($phieuNhap->TrangThai == 0)
                                <span class="badge bg-warning">Chờ duyệt</span>
                            @elseif($phieuNhap->TrangThai == 1)
                                <span class="badge bg-success">Đã duyệt</span>
                            @else
                                <span class="badge bg-danger">Đã hủy</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ghi chú:</th>
                        <td>{{ $phieuNhap->GhiChu ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <h5>Tổng tiền nhập</h5>
                <h2>{{ number_format($phieuNhap->tongTien) }}đ</h2>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Chi tiết sản phẩm nhập</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Kích thước</th>
                    <th class="text-end">Số lượng</th>
                    <th class="text-end">Giá nhập</th>
                    <th class="text-end">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($phieuNhap->chiTiet as $index => $ct)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ct->bienThe->sanPham->TenSP ?? 'N/A' }}</td>
                    <td>{{ $ct->bienThe->kichThuoc->TenKT ?? 'N/A' }}</td>
                    <td class="text-end">{{ $ct->SoLuong }}</td>
                    <td class="text-end">{{ number_format($ct->GiaNhap) }}đ</td>
                    <td class="text-end">{{ number_format($ct->SoLuong * $ct->GiaNhap) }}đ</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-primary">
                    <th colspan="5" class="text-end">Tổng cộng:</th>
                    <th class="text-end">{{ number_format($phieuNhap->tongTien) }}đ</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('admin.kho.phieu-nhap.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Quay lại
    </a>
    @if($phieuNhap->TrangThai == 0)
        <form action="{{ route('admin.kho.phieu-nhap.approve', $phieuNhap->MaPN) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success" onclick="return confirm('Duyệt phiếu nhập này?')">
                <i class="bi bi-check2"></i> Duyệt phiếu
            </button>
        </form>
        <form action="{{ route('admin.kho.phieu-nhap.cancel', $phieuNhap->MaPN) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-warning" onclick="return confirm('Hủy phiếu nhập này?')">
                <i class="bi bi-x"></i> Hủy phiếu
            </button>
        </form>
    @endif
</div>
@endsection
