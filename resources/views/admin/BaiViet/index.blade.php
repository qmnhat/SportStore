@extends('admin.layouts.app')
@section('title', 'Quản lý bài viết')
@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý bài viết</h3>
    </div>

    {{-- Tìm kím + sắp xếp --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.baiviet.index') }}" class="d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Tìm theo tiêu đề bài viết"
                    value="{{ request('q') }}">
                <button type="submit" class="btn btn-primary">Tìm</button>
            </form>
        </div>

        <div class="col-md-3">
            <form method="GET" action="{{ route('admin.baiviet.index') }}">
                <select name="sort" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Sắp xếp theo --</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
            </form>
        </div>

        <div class="col-md-5 text-end">
            <a href="{{ route('admin.baiviet.index') }}" class="btn btn-secondary">Làm mới</a>
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
                    <h4 class="mb-0">Bài viết đang sử dụng</h4>
                    <a href="{{ route('admin.baiviet.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm bài viết
                    </a>
                </div>
                <div class="card-body">
                    @if ($baiviets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tiêu đề</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($baiviets as $baiviet)
                                        <tr>
                                            <td>{{ $baiviet->TieuDe }}</td>
                                            <td>{{ $baiviet->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.baiviet.edit', $baiviet->MaBV) }}"
                                                    class="btn btn-sm btn-warning">Chỉnh sửa</a>
                                                <form action="{{ route('admin.baiviet.destroy', $baiviet->MaBV) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Phân trang --}}
                        <div class="d-flex justify-content-center">
                            {{ $baiviets->withQueryString()->links() }}
                        </div>
                    @else
                        <p class="text-center">Không có bài viết nào.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- TAB DELETED --}}
        <div class="tab-pane fade" id="deleted">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Bài viết đã xóa</h4>
                </div>
                <div class="card-body">
                    @if ($deletedBaiviets->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tiêu đề</th>
                                        <th>Ngày xóa</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deletedBaiviets as $baiviet)
                                        <tr>
                                            <td>{{ $baiviet->TieuDe }}</td>
                                            <td>{{ $baiviet->deleted_at->format('d/m/Y') }}</td>
                                            <td>
                                                <form
                                                    action="{{ route('admin.baiviet.restore', $baiviet->MaBV) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Bạn có chắc chắn muốn khôi phục bài viết này?');">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">Khôi phục</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Phân trang --}}
                        <div class="d-flex justify-content-center">
                            {{ $deletedBaiviets->withQueryString()->links() }}
                        </div>
                    @else
                        <p class="text-center">Không có bài viết đã xóa nào.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
