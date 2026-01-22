@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý sản phẩm</h3>
    </div>

    {{-- Tìm kím + sắp xếp --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.sanpham.index') }}" class="d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Tìm theo tên sản phẩm"
                    value="{{ request('q') }}">
                <button type="submit" class="btn btn-primary">Tìm</button>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ route('admin.sanpham.index') }}">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Sắp xếp theo --</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
            </form>
        </div>

        <div class="col-md-5 text-end">
            <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">Làm mới</a>
        </div>
    </div>

    {{-- Tab --}}
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#active">
                Đang sử dụng
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#deleted">
                Đã xóa
            </button>
        </li>
    </ul>

    <div class="tab-content">

        {{-- TAB ACTIVE --}}
        <div class="tab-pane fade show active" id="active">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Sản phẩm đang sử dụng</h4>
                    <a href="{{ route('admin.sanpham.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm sản phẩm
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã SP</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Thương hiệu</th>
                                <th>Biến thể</th>
                                <th class="text-center">Nổi bật</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activeSP as $sp)
                                <tr>
                                    <td>{{ $sp->MaSP }}</td>
                                    <td>
                                        @if ($sp->hinhAnh && $sp->hinhAnh->count() > 0)
                                            <img src="{{ asset($sp->hinhAnh->first()->DuongDan) }}"
                                                style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                        @else
                                            <span class="text-muted"><i class="fas fa-image"></i></span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $sp->TenSP }}</strong></td>
                                    <td>{{ $sp->danhMuc->TenDM ?? '-' }}</td>
                                    <td>{{ $sp->thuongHieu->TenTH ?? '-' }}</td>
                                    <td>
                                        @if ($sp->bienThe && $sp->bienThe->count() > 0)
                                            <span class="badge bg-info">{{ $sp->bienThe->count() }} size</span>
                                            <br><small class="text-muted">
                                                {{ number_format($sp->bienThe->min('GiaGoc')) }}đ - {{ number_format($sp->bienThe->max('GiaGoc')) }}đ
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($sp->NoiBat)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($sp->TrangThai == 1)
                                            <span class="badge bg-success">Hoạt động</span>
                                        @else
                                            <span class="badge bg-warning">Ẩn</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.sanpham.edit', $sp->MaSP) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.sanpham.destroy', $sp->MaSP) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Xác nhận xóa sản phẩm này?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center text-muted">
                                        Không có dữ liệu
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $activeSP->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- TAB DELETED --}}
        <div class="tab-pane fade" id="deleted">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Sản phẩm đã xóa</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã SP</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Thương hiệu</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deletedSP as $sp)
                                <tr>
                                    <td>{{ $sp->MaSP }}</td>
                                    <td>
                                        @if ($sp->hinhAnh && $sp->hinhAnh->count() > 0)
                                            <img src="{{ asset($sp->hinhAnh->first()->DuongDan) }}"
                                                style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                        @else
                                            <span class="text-muted"><i class="fas fa-image"></i></span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $sp->TenSP }}</strong></td>
                                    <td>{{ $sp->danhMuc->TenDM ?? '-' }}</td>
                                    <td>{{ $sp->thuongHieu->TenTH ?? '-' }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.sanpham.restore', $sp->MaSP) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"
                                                onclick="return confirm('Khôi phục sản phẩm này?')">
                                                <i class="fas fa-undo"></i> Khôi phục
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
                                        Không có dữ liệu
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>

@endsection

