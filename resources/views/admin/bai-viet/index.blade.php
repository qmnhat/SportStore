@extends('admin.layouts.app')

@section('title', 'Quản lý Bài Viết')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách Bài Viết</h5>
                    <a href="{{ route('admin.bai-viet.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus me-2"></i>Thêm Bài Viết
                    </a>
                </div>

                <div class="card-body">
                    {{-- Tìm kiếm --}}
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <form action="{{ route('admin.bai-viet.index') }}" method="GET" class="d-flex gap-2">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm bài viết..."
                                    value="{{ request('search') }}">
                                <select name="category" class="form-select" style="max-width: 200px;">
                                    <option value="">-- Tất cả danh mục --</option>
                                    @forelse($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->TenDanhMuc }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>

                    {{-- Bảng dữ liệu --}}
                    @if($baiViets->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 25%">Tiêu đề</th>
                                    <th style="width: 15%">Danh mục</th>
                                    <th style="width: 10%">Trạng thái</th>
                                    <th style="width: 10%">Lượt xem</th>
                                    <th style="width: 15%">Ngày tạo</th>
                                    <th style="width: 20%">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($baiViets as $baiViet)
                                <tr>
                                    <td>{{ $baiViet->MaBV }}</td>
                                    <td>
                                        <strong>{{ $baiViet->TieuDe }}</strong>
                                        <br>
                                        <small class="text-muted">Slug: {{ $baiViet->slug }}</small>
                                    </td>
                                    <td>
                                        @if($baiViet->category)
                                            <span class="badge bg-info">{{ $baiViet->category->TenDanhMuc }}</span>
                                        @else
                                            <span class="badge bg-secondary">Không có</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($baiViet->TrangThai == 1)
                                            <span class="badge bg-success">Công khai</span>
                                        @else
                                            <span class="badge bg-warning">Nháp</span>
                                        @endif
                                    </td>
                                    <td>{{ $baiViet->LuotXem ?? 0 }}</td>
                                    <td>{{ $baiViet->NgayTao?->format('d/m/Y H:i') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.bai-viet.show', $baiViet->MaBV) }}" class="btn btn-info" title="Xem">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.bai-viet.edit', $baiViet->MaBV) }}" class="btn btn-warning" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.bai-viet.destroy', $baiViet->MaBV) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Bạn chắc chắn muốn xóa bài viết này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Xóa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Phân trang --}}
                    <div class="d-flex justify-content-center">
                        {{ $baiViets->links() }}
                    </div>
                    @else
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>Không có bài viết nào
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
