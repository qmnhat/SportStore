@extends('admin.layouts.app')

@section('title', 'Quản lý Chính sách')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-md-8">
            <h2><i class="bi bi-file-earmark-check"></i> Quản lý Chính sách</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.policies.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm chính sách
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Loại</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Thứ tự</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($policies as $policy)
                    <tr>
                        <td>#{{ $policy->id }}</td>
                        <td>
                            <span class="badge bg-info">{{ $policy->type }}</span>
                        </td>
                        <td>{{ $policy->title }}</td>
                        <td>{{ Str::limit(strip_tags($policy->content), 50) }}</td>
                        <td>{{ $policy->order }}</td>
                        <td>
                            <a href="{{ route('admin.policies.edit', $policy->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Sửa
                            </a>
                            <form action="{{ route('admin.policies.destroy', $policy->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Chắc chắn xóa?')">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $policies->links() }}
    </div>
</div>
@endsection
