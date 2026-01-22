@extends('admin.layouts.app')

@section('title', 'Phiếu nhập kho')

@section('content')
<div class="page-heading mb-4">
    <h3>Quản lý Phiếu nhập kho</h3>
</div>

{{-- Bộ lọc --}}
<div class="row mb-3">
    <div class="col-md-4">
        <form method="GET" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Tìm mã phiếu, NCC..." value="{{ request('q') }}">
            <button class="btn btn-primary">Tìm</button>
        </form>
    </div>
    <div class="col-md-3">
        <form method="GET">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Lọc trạng thái --</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Chờ duyệt</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đã duyệt</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </form>
    </div>
    <div class="col-md-5 text-end">
        <a href="{{ route('admin.kho.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Về tồn kho
        </a>
        <a href="{{ route('admin.kho.phieu-nhap.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tạo phiếu nhập
        </a>
    </div>
</div>

{{-- Tabs --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#active">Đang hoạt động</button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#deleted">Đã xóa</button>
    </li>
</ul>

<div class="tab-content">
    {{-- ACTIVE --}}
    <div class="tab-pane fade show active" id="active">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Danh sách phiếu nhập</h4>
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
                            <th>Mã PN</th>
                            <th>Nhà cung cấp</th>
                            <th>Ngày nhập</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Người tạo</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activePN as $pn)
                        <tr>
                            <td><strong>#{{ $pn->MaPN }}</strong></td>
                            <td>{{ $pn->nhaCungCap->TenNCC ?? 'N/A' }}</td>
                            <td>{{ $pn->NgayNhap->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($pn->tongTien) }}đ</td>
                            <td>
                                @if($pn->TrangThai == 0)
                                    <span class="badge bg-warning">Chờ duyệt</span>
                                @elseif($pn->TrangThai == 1)
                                    <span class="badge bg-success">Đã duyệt</span>
                                @else
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td>
                            <td>{{ $pn->nhaQuanLy->HoTen ?? 'N/A' }}</td>
                            <td class="text-center">
                                {{-- Nút Xem luôn hiển thị --}}
                                <a href="{{ route('admin.kho.phieu-nhap.show', $pn->MaPN) }}" class="btn btn-sm btn-info" title="Xem chi tiết">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Chỉ hiển thị nút duyệt/hủy/xóa khi đang chờ duyệt --}}
                                @if($pn->TrangThai == 0)
                                    <form action="{{ route('admin.kho.phieu-nhap.approve', $pn->MaPN) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" title="Duyệt phiếu" onclick="return confirm('Duyệt phiếu nhập này? Tồn kho sẽ được cộng thêm.')">
                                            <i class="bi bi-check2"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.kho.phieu-nhap.cancel', $pn->MaPN) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" title="Hủy phiếu" onclick="return confirm('Hủy phiếu nhập này?')">
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.kho.phieu-nhap.destroy', $pn->MaPN) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa phiếu" onclick="return confirm('Xóa phiếu nhập này?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $activePN->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- DELETED --}}
    <div class="tab-pane fade" id="deleted">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Phiếu nhập đã xóa</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã PN</th>
                            <th>Nhà cung cấp</th>
                            <th>Ngày nhập</th>
                            <th>Ngày xóa</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deletedPN as $pn)
                        <tr>
                            <td>#{{ $pn->MaPN }}</td>
                            <td>{{ $pn->nhaCungCap->TenNCC ?? 'N/A' }}</td>
                            <td>{{ $pn->NgayNhap->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pn->DeletedAt)->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.kho.phieu-nhap.restore', $pn->MaPN) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Khôi phục phiếu nhập này?')">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
