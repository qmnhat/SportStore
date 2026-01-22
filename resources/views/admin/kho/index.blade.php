@extends('admin.layouts.app')

@section('title', 'Quản lý Kho')

@section('content')
<div class="page-heading mb-4">
    <h3>Quản lý Kho - Tồn kho</h3>
</div>

{{-- Thống kê --}}
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Tổng biến thể</h5>
                <h2>{{ $thongKe['tongSanPham'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Sắp hết hàng</h5>
                <h2>{{ $thongKe['sapHet'] }}</h2>
                <small>(≤ 10 sản phẩm)</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Hết hàng</h5>
                <h2>{{ $thongKe['hetHang'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Tổng tồn kho</h5>
                <h2>{{ number_format($thongKe['tongTonKho']) }}</h2>
            </div>
        </div>
    </div>
</div>

{{-- Bộ lọc --}}
<div class="row mb-3">
    <div class="col-md-4">
        <form method="GET" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Tìm tên sản phẩm..." value="{{ request('q') }}">
            <button class="btn btn-primary">Tìm</button>
        </form>
    </div>
    <div class="col-md-3">
        <form method="GET">
            <select name="stock" class="form-select" onchange="this.form.submit()">
                <option value="">-- Lọc tồn kho --</option>
                <option value="available" {{ request('stock') == 'available' ? 'selected' : '' }}>Còn hàng (> 10)</option>
                <option value="low" {{ request('stock') == 'low' ? 'selected' : '' }}>Sắp hết (1-10)</option>
                <option value="out" {{ request('stock') == 'out' ? 'selected' : '' }}>Hết hàng (0)</option>
            </select>
        </form>
    </div>
    <div class="col-md-3">
        <form method="GET">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="">-- Sắp xếp --</option>
                <option value="stock_asc" {{ request('sort') == 'stock_asc' ? 'selected' : '' }}>Tồn kho tăng dần</option>
                <option value="stock_desc" {{ request('sort') == 'stock_desc' ? 'selected' : '' }}>Tồn kho giảm dần</option>
            </select>
        </form>
    </div>
    <div class="col-md-2 text-end">
        <a href="{{ route('admin.kho.phieu-nhap.index') }}" class="btn btn-success">
            <i class="bi bi-box-arrow-in-down"></i> Phiếu nhập
        </a>
    </div>
</div>

{{-- Bảng tồn kho --}}
<div class="card">
    <div class="card-header">
        <h4 class="mb-0">Danh sách tồn kho theo biến thể</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mã BT</th>
                    <th>Sản phẩm</th>
                    <th>Kích thước</th>
                    <th>Giá gốc</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Cập nhật</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tonKho as $bt)
                <tr>
                    <td>{{ $bt->MaBT }}</td>
                    <td>{{ $bt->sanPham->TenSP ?? 'N/A' }}</td>
                    <td>{{ $bt->kichThuoc->TenKT ?? 'N/A' }}</td>
                    <td>{{ number_format($bt->GiaGoc) }}đ</td>
                    <td>
                        <strong class="{{ $bt->SoLuong <= 0 ? 'text-danger' : ($bt->SoLuong <= 10 ? 'text-warning' : 'text-success') }}">
                            {{ $bt->SoLuong }}
                        </strong>
                    </td>
                    <td>
                        @if($bt->SoLuong <= 0)
                            <span class="badge bg-danger">Hết hàng</span>
                        @elseif($bt->SoLuong <= 10)
                            <span class="badge bg-warning">Sắp hết</span>
                        @else
                            <span class="badge bg-success">Còn hàng</span>
                        @endif
                    </td>

                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $tonKho->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
