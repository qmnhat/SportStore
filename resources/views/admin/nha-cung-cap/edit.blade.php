@extends('admin.layouts.app')

@section('title', 'Sửa nhà cung cấp')

@section('content')
<div class="page-heading mb-4">
    <h3>Sửa nhà cung cấp</h3>
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

        <form action="{{ route('admin.nhacungcap.update', $nhaCungCap->MaNCC) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tên nhà cung cấp <span class="text-danger">*</span></label>
                <input type="text" name="TenNCC" class="form-control" value="{{ old('TenNCC', $nhaCungCap->TenNCC) }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control" value="{{ old('Email', $nhaCungCap->Email) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="SDT" class="form-control" value="{{ old('SDT', $nhaCungCap->SDT) }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="DiaChi" class="form-control" rows="2">{{ old('DiaChi', $nhaCungCap->DiaChi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select name="TrangThai" class="form-select">
                    <option value="1" {{ old('TrangThai', $nhaCungCap->TrangThai) == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ old('TrangThai', $nhaCungCap->TrangThai) == 0 ? 'selected' : '' }}>Ngưng</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.nhacungcap.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
