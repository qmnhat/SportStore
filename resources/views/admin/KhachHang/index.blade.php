@extends('admin.layouts.app')

@section('title', 'Quản lý khách hàng')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý khách hàng</h3>
    </div>

    {{-- Tìm kiếm + Lọc --}}
    {{-- Tìm kiếm + Lọc + Sắp xếp --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.khachhang.index') }}" class="d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Tìm theo tên hoặc email"
                    value="{{ request('q') }}">
                <button type="submit" class="btn btn-primary">Tìm</button>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ route('admin.khachhang.index') }}">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Lọc trạng thái --</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Blocked</option>
                </select>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ route('admin.khachhang.index') }}">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Sắp xếp theo --</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
            </form>
        </div>

        <div class="col-md-2 text-end">
            <a href="{{ route('admin.khachhang.index') }}" class="btn btn-secondary">Làm mới</a>
        </div>
    </div>


    {{-- Tab --}}
    <ul class="nav nav-tabs mb-3" id="khachhangTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="active-tab" data-bs-toggle="tab" data-bs-target="#active" type="button"
                role="tab">Đang hoạt động</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="deleted-tab" data-bs-toggle="tab" data-bs-target="#deleted" type="button"
                role="tab">Đã xóa</button>
        </li>
    </ul>

    <div class="tab-content" id="khachhangTabContent">

        {{-- Tab Đang hoạt động --}}
        <div class="tab-pane fade show active" id="active" role="tabpanel">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Khách hàng đang hoạt động</h4>
                    <a href="{{ route('admin.khachhang.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm khách hàng
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã KH</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>SĐT</th>
                                <th>Ngày sinh</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($activeKH as $kh)
                                <tr>
                                    <td>{{ $kh->MaKH }}</td>
                                    <td>{{ $kh->HoTen }}</td>
                                    <td>{{ $kh->Email }}</td>
                                    <td>{{ $kh->DiaChi }}</td>
                                    <td>{{ $kh->SDT }}</td>
                                    <td>{{ $kh->NgaySinh ? $kh->NgaySinh->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if ($kh->TrangThai)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Blocked</span>
                                        @endif
                                    </td>
                                    <td>{{ $kh->NgayTao->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.khachhang.edit', $kh->MaKH) }}"
                                            class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                                        <form action="{{ route('admin.khachhang.destroy', $kh->MaKH) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Xác nhận xóa khách hàng này?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Phân trang --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $activeKH->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>

        {{-- Tab Đã xóa --}}
        <div class="tab-pane fade" id="deleted" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Khách hàng đã xóa</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã KH</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>SĐT</th>
                                <th>Ngày sinh</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deletedKH as $kh)
                                <tr>
                                    <td>{{ $kh->MaKH }}</td>
                                    <td>{{ $kh->HoTen }}</td>
                                    <td>{{ $kh->Email }}</td>
                                    <td>{{ $kh->DiaChi }}</td>
                                    <td>{{ $kh->SDT }}</td>
                                    <td>{{ $kh->NgaySinh ? $kh->NgaySinh->format('d/m/Y') : '-' }}</td>
                                    <td>
                                        @if ($kh->TrangThai)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Blocked</span>
                                        @endif
                                    </td>
                                    <td>{{ $kh->NgayTao->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.khachhang.restore', $kh->MaKH) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('Khôi phục khách hàng này?')">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Phân trang --}}
                    <div class="d-flex justify-content-center mt-3">
                        {{ $activeKH->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>
    </div>

    </div>

@endsection
