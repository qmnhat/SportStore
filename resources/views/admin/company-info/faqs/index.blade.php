@extends('admin.layouts.app')

@section('title', 'Quản lý FAQ')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-3">
        <div class="col-md-8">
            <h2><i class="bi bi-question-circle"></i> Quản lý Câu hỏi thường gặp</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm câu hỏi
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
                        <th>Câu hỏi</th>
                        <th>Câu trả lời</th>
                        <th>Thứ tự</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $faq)
                    <tr>
                        <td>#{{ $faq->id }}</td>
                        <td>{{ Str::limit($faq->question, 40) }}</td>
                        <td>{{ Str::limit(strip_tags($faq->answer), 50) }}</td>
                        <td>{{ $faq->order }}</td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Sửa
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
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
        {{ $faqs->links() }}
    </div>
</div>
@endsection
