@extends('admin.layouts.app')

@section('title', 'Thêm Danh mục Blog')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thêm Danh mục Mới</h5>
                </div>

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

                    <form action="{{ route('admin.blog-category.store') }}" method="POST">
                        @csrf

                        {{-- Tên danh mục --}}
                        <div class="mb-3">
                            <label for="TenDanhMuc" class="form-label">
                                <strong>Tên Danh mục <span class="text-danger">*</span></strong>
                            </label>
                            <input type="text" class="form-control @error('TenDanhMuc') is-invalid @enderror"
                                id="TenDanhMuc" name="TenDanhMuc" value="{{ old('TenDanhMuc') }}"
                                placeholder="Nhập tên danh mục" required>
                            @error('TenDanhMuc')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-3">
                            <label for="MoTa" class="form-label">
                                <strong>Mô tả</strong>
                            </label>
                            <textarea class="form-control @error('MoTa') is-invalid @enderror"
                                id="MoTa" name="MoTa" rows="3" placeholder="Nhập mô tả danh mục">{{ old('MoTa') }}</textarea>
                            @error('MoTa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Trạng thái --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Trạng thái</strong>
                            </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="TrangThai1"
                                    name="TrangThai" value="1" @checked(old('TrangThai', 1) == 1)>
                                <label class="form-check-label" for="TrangThai1">
                                    Công khai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="TrangThai0"
                                    name="TrangThai" value="0" @checked(old('TrangThai') == 0)>
                                <label class="form-check-label" for="TrangThai0">
                                    Nháp
                                </label>
                            </div>
                        </div>

                        {{-- Nút hành động --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Lưu Danh mục
                            </button>
                            <a href="{{ route('admin.blog-category.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
