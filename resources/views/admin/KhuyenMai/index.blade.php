@extends('admin.layouts.app')

@section('title', 'Quản lý khuyến mãi')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý khuyến mãi</h3>
    </div>

    {{-- Tìm kiếm + Lọc + Sắp xếp --}}
    <div class="row mb-3">

        {{-- Tìm kiếm --}}
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.khuyenmai.index') }}" class="d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Tìm theo tên khuyến mãi"
                    value="{{ request('q') }}">
                <button type="submit" class="btn btn-primary">Tìm</button>
            </form>
        </div>

        {{-- Lọc trạng thái --}}
        <div class="col-md-3">
            <form method="GET" action="{{ route('admin.khuyenmai.index') }}">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Lọc trạng thái --</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </form>
        </div>

        {{-- Sắp xếp --}}
        <div class="col-md-3">
            <form method="GET" action="{{ route('admin.khuyenmai.index') }}">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Sắp xếp --</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
            </form>
        </div>

        <div class="col-md-2 text-end">
            <a href="{{ route('admin.khuyenmai.index') }}" class="btn btn-secondary">Làm mới</a>
        </div>

    </div>

    {{-- Tab --}}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#active">
                Đang hoạt động
            </button>
        </li>

        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#deleted">
                Đã xóa
            </button>
        </li>
    </ul>

    <div class="tab-content">

        {{-- ACTIVE --}}
        <div class="tab-pane fade show active" id="active">

            <div class="card">

                <div class="card-header d-flex justify-content-between">
                    <h4 class="mb-0">Khuyến mãi đang hoạt động</h4>

                    <a href="{{ route('admin.khuyenmai.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm khuyến mãi
                    </a>
                </div>

                <div class="card-body">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Mã KM</th>
                                <th>Tên KM</th>
                                <th>% Giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($activeKM as $km)
                                <tr>
                                    <td>{{ $km->MaKM }}</td>
                                    <td>{{ $km->TenKM }}</td>
                                    <td>{{ $km->PhanTramGiam }}%</td>

                                    <td>{{ \Carbon\Carbon::parse($km->NgayBatDau)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($km->NgayKetThuc)->format('d/m/Y') }}</td>

                                    <td>
                                        @if ($km->TrangThai)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('admin.khuyenmai.edit', $km->MaKM) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.khuyenmai.destroy', $km->MaKM) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Xác nhận xóa khuyến mãi?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

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
                        {{ $activeKM->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>

        {{-- DELETED --}}
        <div class="tab-pane fade" id="deleted">

            <div class="card">

                <div class="card-header">
                    <h4 class="mb-0">Khuyến mãi đã xóa</h4>
                </div>

                <div class="card-body">

                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Mã KM</th>
                                <th>Tên KM</th>
                                <th>% Giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($deletedKM as $km)
                                <tr>
                                    <td>{{ $km->MaKM }}</td>
                                    <td>{{ $km->TenKM }}</td>
                                    <td>{{ $km->PhanTramGiam }}%</td>

                                    <td>{{ \Carbon\Carbon::parse($km->NgayBatDau)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($km->NgayKetThuc)->format('d/m/Y') }}</td>

                                    <td class="text-center">
                                        <form action="{{ route('admin.khuyenmai.restore', $km->MaKM) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-success"
                                                onclick="return confirm('Khôi phục khuyến mãi?')">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>
            </div>
        </div>

    </div>

@endsection
