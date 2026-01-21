@extends('admin.layouts.app')

@section('title', 'Quản lý kích thước')

@section('content')
    <div class="page-heading mb-4">
        <h3>Quản lý kích thước</h3>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Danh sách kích thước</h5>
                </div>

                <div class="card-body">
                    <a href="{{ route('admin.kichthuoc.create') }}" class="btn btn-primary btn-sm mb-3">
                        <i class="bi bi-plus-circle"></i> Thêm kích thước
                    </a>

                    {{-- Messages --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if($kichThuocs->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:80px;">Mã</th>
                                    <th>Tên kích thước</th>
                                    <th style="width:120px;">Số SP sử dụng</th>
                                    <th style="width:140px;" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kichThuocs as $kt)
                                <tr>
                                    <td>{{ $kt->MaKT }}</td>
                                    <td><strong>{{ $kt->TenKT }}</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ $kt->bienThes()->count() }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.kichthuoc.edit', $kt->MaKT) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.kichthuoc.destroy', $kt->MaKT) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Xác nhận xóa kích thước này?')">
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
                        {{ $kichThuocs->links('pagination::bootstrap-5') }}
                    </div>
                    @else
                    <div class="alert alert-info">Chưa có kích thước nào</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
