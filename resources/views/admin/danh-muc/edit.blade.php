@extends('admin.layouts.app')

@section('title', 'Sửa danh mục')

@section('content')
    <div class="page-heading mb-4">
        <h3>Sửa danh mục: {{ $danhMuc->TenDM }}</h3>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sửa thông tin danh mục</h5>
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

                    <form action="{{ route('admin.danhmuc.update', $danhMuc->MaDM) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Tên danh mục --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Tên danh mục <span class="text-danger">*</span></strong>
                            </label>
                            <input type="text" name="TenDM" class="form-control @error('TenDM') is-invalid @enderror"
                                value="{{ old('TenDM', $danhMuc->TenDM) }}" placeholder="Nhập tên danh mục" required>
                            @error('TenDM')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug (read-only) --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Slug (URL)</strong>
                            </label>
                            <input type="text" class="form-control" value="{{ $danhMuc->slug }}" readonly>
                            <small class="text-muted">Slug tự động generate từ tên danh mục</small>
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Mô tả</strong>
                            </label>
                            <textarea name="MoTa" class="form-control @error('MoTa') is-invalid @enderror"
                                rows="4" placeholder="Nhập mô tả danh mục">{{ old('MoTa', $danhMuc->MoTa) }}</textarea>
                            @error('MoTa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.danhmuc.index') }}" class="btn btn-secondary">
                                Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
