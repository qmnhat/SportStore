@extends('admin.layouts.app')

@section('title', 'Thêm nhà cung cấp')

@section('content')
<div class="page-heading mb-4">
    <h3>Thêm nhà cung cấp mới</h3>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.nhacungcap.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tên nhà cung cấp <span class="text-danger">*</span></label>
                <input type="text" name="TenNCC" class="form-control" value="{{ old('TenNCC') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" value="{{ old('Email') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="SDT" class="form-control" value="{{ old('SDT') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="DiaChi" class="form-control" rows="2">{{ old('DiaChi') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="TrangThai" class="form-select">
                    <option value="1" {{ old('TrangThai', 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ old('TrangThai') === '0' ? 'selected' : '' }}>Ngưng</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.nhacungcap.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Lưu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
