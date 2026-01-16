@extends('admin.layouts.app')

@section('title', 'Sửa chính sách')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sửa chính sách</h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.policies.update', $policy->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Loại chính sách</label>
                            <select name="type" class="form-select" required>
                                <option value="shipping" {{ $policy->type == 'shipping' ? 'selected' : '' }}>Vận chuyển</option>
                                <option value="payment" {{ $policy->type == 'payment' ? 'selected' : '' }}>Thanh toán</option>
                                <option value="return" {{ $policy->type == 'return' ? 'selected' : '' }}>Đổi trả</option>
                                <option value="security" {{ $policy->type == 'security' ? 'selected' : '' }}>Bảo mật</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề</label>
                            <input type="text" name="title" class="form-control" value="{{ $policy->title }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung (HTML)</label>
                            <textarea name="content" class="form-control" rows="6" required>{{ $policy->content }}</textarea>
                            <small class="text-muted">Hỗ trợ HTML tags</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Thứ tự</label>
                            <input type="number" name="order" class="form-control" value="{{ $policy->order }}">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.policies.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
