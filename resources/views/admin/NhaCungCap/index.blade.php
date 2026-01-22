@extends('admin.layouts.app')

@section('title', 'Quản lý nhà cung cấp')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý nhà cung cấp</h3>
    </div>

    {{-- Search + Filter + Sort --}}
    <div class="row mb-3">

        <div class="col-md-4">
            <form method="GET" action="{{ url('/admin/nha-cung-cap') }}" class="d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Tìm theo tên hoặc email"
                    value="{{ request('q') }}">
                <button class="btn btn-primary">Tìm</button>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ url('/admin/nha-cung-cap') }}">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Lọc trạng thái --</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ngưng</option>
                </select>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ url('/admin/nha-cung-cap') }}">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Sắp xếp --</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
            </form>
        </div>

        <div class="col-md-2 text-end">
            <a href="{{ url('/admin/nha-cung-cap') }}" class="btn btn-secondary">
                Làm mới
            </a>
        </div>

    </div>

    {{-- Tabs --}}
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

                    <h4 class="mb-0">Nhà cung cấp đang hoạt động</h4>

                    <a href="{{ url('/admin/nha-cung-cap/create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm NCC
                    </a>

                </div>

                <div class="card-body">

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã</th>
                                <th>Tên NCC</th>
                                <th>Email</th>
                                <th>SĐT</th>
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

                                    <td>
                                        @if ($ncc->TrangThai)
                                            <span class="badge bg-success">Hoạt động</span>
                                        @else
                                            <span class="badge bg-secondary">Ngưng</span>
                                        @endif
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($ncc->NgayTao)->format('d/m/Y') }}</td>

                                    <td class="text-center">

                                        <a href="{{ url('/admin/nha-cung-cap/edit/' . $ncc->MaNCC) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="{{ url('/admin/nha-cung-cap/delete/' . $ncc->MaNCC) }}"
                                            onclick="return confirm('Xóa nhà cung cấp này?')" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>

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
                        {{ $activeNCC->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>

        {{-- DELETED --}}
        <div class="tab-pane fade" id="deleted">

            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Nhà cung cấp đã xóa</h4>
                </div>

                <div class="card-body">

                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã</th>
                                <th>Tên NCC</th>
                                <th>Email</th>
                                <th>SĐT</th>
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
                                    <td>{{ $ncc->SDT }}</td>

                                    <td>{{ \Carbon\Carbon::parse($ncc->DeletedAt)->format('d/m/Y') }}</td>

                                    <td class="text-center">

                                        <a href="{{ url('/admin/nha-cung-cap/restore/' . $ncc->MaNCC) }}"
                                            onclick="return confirm('Khôi phục NCC này?')" class="btn btn-sm btn-success">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                        </a>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Không có dữ liệu</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $deletedNCC->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection
