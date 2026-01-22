@extends('admin.layouts.app')

@section('title', 'Quản lý nhà cung cấp')

@section('content')
<div class="page-heading mb-4">
    <h3>Quản lý nhà cung cấp</h3>
</div>

{{-- Bộ lọc --}}
<div class="row mb-3">
    <div class="col-md-4">
        <form method="GET" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Tìm tên, email..." value="{{ request('q') }}">
            <button class="btn btn-primary">Tìm</button>
        </form>
    </div>
    <div class="col-md-3">
        <form method="GET">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Lọc trạng thái --</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Hoạt động</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Ngưng</option>
            </select>
        </form>
    </div>
    <div class="col-md-2">
        <form method="GET">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="">-- Sắp xếp --</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
            </select>
        </form>
    </div>
    <div class="col-md-3 text-end">
        <a href="{{ route('admin.nhacungcap.index') }}" class="btn btn-secondary">Làm mới</a>
        <a href="{{ route('admin.nhacungcap.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Thêm NCC
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
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã</th>
                            <th>Tên NCC</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activeNCC as $ncc)
                        <tr>
                            <td>{{ $ncc->MaNCC }}</td>
                            <td>{{ $ncc->TenNCC }}</td>
                            <td>{{ $ncc->Email }}</td>
                            <td>{{ $ncc->SDT }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($ncc->DiaChi, 30) }}</td>
                            <td>
                                @if($ncc->TrangThai)
                                    <span class="badge bg-success">Hoạt động</span>
                                @else
                                    <span class="badge bg-secondary">Ngưng</span>
                                @endif
                            </td>
                            <td>{{ $ncc->NgayTao ? $ncc->NgayTao->format('d/m/Y') : '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.nhacungcap.edit', $ncc->MaNCC) }}" class="btn btn-sm btn-warning" title="Sửa">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.nhacungcap.destroy', $ncc->MaNCC) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" title="Xóa" onclick="return confirm('Xóa nhà cung cấp này?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $activeNCC->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- DELETED --}}
    <div class="tab-pane fade" id="deleted">
        <div class="card">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã</th>
                            <th>Tên NCC</th>
                            <th>Email</th>
                            <th>Ngày xóa</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($deletedNCC as $ncc)
                        <tr>
                            <td>{{ $ncc->MaNCC }}</td>
                            <td>{{ $ncc->TenNCC }}</td>
                            <td>{{ $ncc->Email }}</td>
                            <td>{{ $ncc->DeletedAt ? $ncc->DeletedAt->format('d/m/Y') : '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.nhacungcap.restore', $ncc->MaNCC) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Khôi phục NCC này?')">
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
