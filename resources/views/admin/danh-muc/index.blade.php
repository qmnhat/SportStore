@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')
    {{-- Page heading --}}
    <div class="page-heading mb-4">
        <h3>Quản lý danh mục sản phẩm</h3>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                {{-- Tabs: Active/Deleted --}}
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="active-tab" data-bs-toggle="tab" href="#active" role="tab">
                                Danh sách danh mục
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="deleted-tab" data-bs-toggle="tab" href="#deleted" role="tab">
                                Đã xóa
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <a href="{{ route('admin.danhmuc.create') }}" class="btn btn-primary btn-sm mb-3">
                        <i class="bi bi-plus-circle"></i> Thêm danh mục
                    </a>

                    {{-- Messages --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    {{-- Tabs Content --}}
                    <div class="tab-content">
                        {{-- ACTIVE TAB --}}
                        <div class="tab-pane fade show active" id="active" role="tabpanel">
                            @if($activeDM->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:80px;">Mã</th>
                                            <th>Tên danh mục</th>
                                            <th>Slug</th>
                                            <th>Mô tả</th>
                                            <th style="width:140px;" class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($activeDM as $dm)
                                        <tr>
                                            <td>{{ $dm->MaDM }}</td>
                                            <td><strong>{{ $dm->TenDM }}</strong></td>
                                            <td>
                                                <code>{{ $dm->slug }}</code>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ Str::limit($dm->MoTa, 50, '...') ?? '-' }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.danhmuc.edit', $dm->MaDM) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('admin.danhmuc.destroy', $dm->MaDM) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Xác nhận xóa danh mục này?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-center mt-4">
                                {{ $activeDM->links('pagination::bootstrap-5') }}
                            </div>
                            @else
                            <div class="alert alert-info">Không có danh mục nào</div>
                            @endif
                        </div>

                        {{-- DELETED TAB --}}
                        <div class="tab-pane fade" id="deleted" role="tabpanel">
                            @if($deletedDM->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width:80px;">Mã</th>
                                            <th>Tên danh mục</th>
                                            <th>Slug</th>
                                            <th>Mô tả</th>
                                            <th style="width:140px;" class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($deletedDM as $dm)
                                        <tr>
                                            <td>{{ $dm->MaDM }}</td>
                                            <td><strong>{{ $dm->TenDM }}</strong></td>
                                            <td>
                                                <code>{{ $dm->slug }}</code>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ Str::limit($dm->MoTa, 50, '...') ?? '-' }}
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.danhmuc.restore', $dm->MaDM) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="bi bi-arrow-counterclockwise"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-center mt-4">
                                {{ $deletedDM->links('pagination::bootstrap-5') }}
                            </div>
                            @else
                            <div class="alert alert-info">Không có danh mục nào bị xóa</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
