@extends('admin.layouts.app')

@section('title', isset($policy) ? 'Sửa chính sách' : 'Tạo chính sách')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        {{ isset($policy) ? 'Sửa chính sách' : 'Tạo chính sách mới' }}
                    </h5>
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

                    <form method="POST" action="{{ isset($policy) ? route('admin.policies.update', $policy->id) : route('admin.policies.store') }}">
                        @csrf
                        @if(isset($policy))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Loại chính sách</label>
                            <select name="type" class="form-select" required>
                                <option value="">-- Chọn --</option>
                                <option value="shipping" {{ isset($policy) && $policy->type == 'shipping' ? 'selected' : '' }}>Vận chuyển</option>
                                <option value="payment" {{ isset($policy) && $policy->type == 'payment' ? 'selected' : '' }}>Thanh toán</option>
                                <option value="return" {{ isset($policy) && $policy->type == 'return' ? 'selected' : '' }}>Đổi trả</option>
                                <option value="security" {{ isset($policy) && $policy->type == 'security' ? 'selected' : '' }}>Bảo mật</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ isset($policy) ? $policy->title : '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung (HTML)</label>
                            <textarea name="content" class="form-control" rows="6" required>{{ isset($policy) ? $policy->content : '' }}</textarea>
                            <small class="text-muted">Hỗ trợ HTML tags</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Thứ tự</label>
                            <input type="number" name="order" class="form-control"
                                   value="{{ isset($policy) ? $policy->order : 0 }}">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.policies.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> {{ isset($policy) ? 'Cập nhật' : 'Tạo mới' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
