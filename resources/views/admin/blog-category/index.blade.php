@extends('admin.layouts.app')

@section('title', 'Quản lý Danh mục Blog')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Danh sách Danh mục Blog</h5>
                    <a href="{{ route('admin.blog-category.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus me-2"></i>Thêm Danh mục
                    </a>
                </div>

                <div class="card-body">
                    @if($categories->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th style="width: 30%">Tên Danh mục</th>
                                    <th style="width: 20%">Slug</th>
                                    <th style="width: 10%">Trạng thái</th>
                                    <th style="width: 10%">Bài viết</th>
                                    <th style="width: 15%">Ngày tạo</th>
                                    <th style="width: 15%">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td><strong>{{ $category->TenDanhMuc }}</strong></td>
                                    <td><code>{{ $category->slug }}</code></td>
                                    <td>
                                        @if($category->TrangThai == 1)
                                            <span class="badge bg-success">Công khai</span>
                                        @else
                                            <span class="badge bg-warning">Nháp</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $category->posts_count ?? 0 }} bài
                                        </span>
                                    </td>
                                    <td>{{ $category->created_at?->format('d/m/Y H:i') ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.blog-category.edit', $category->id) }}" class="btn btn-warning" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.blog-category.destroy', $category->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Bạn chắc chắn muốn xóa danh mục này?');">
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
                    @else
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>Không có danh mục nào
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
