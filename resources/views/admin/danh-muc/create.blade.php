@extends('admin.layouts.app')

@section('title', 'Thêm danh mục')

@section('content')
    <div class="page-heading mb-4">
        <h3>Thêm danh mục sản phẩm</h3>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Thêm danh mục mới</h5>
                </div>


                    @endif

                    <form action="{{ route('admin.danhmuc.store') }}" method="POST">
                        @csrf

                        {{-- Tên danh mục --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Tên danh mục <span class="text-danger">*</span></strong>
                            </label>
                            <input type="text" name="TenDM" class="form-control @error('TenDM') is-invalid @enderror"
                                value="{{ old('TenDM') }}" placeholder="Nhập tên danh mục" required>
                            @error('TenDM')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Mô tả</strong>
                            </label>
                            <textarea name="MoTa" class="form-control @error('MoTa') is-invalid @enderror"
                                rows="4" placeholder="Nhập mô tả danh mục">{{ old('MoTa') }}</textarea>
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
                                <i class="bi bi-check-circle me-1"></i> Lưu danh mục
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
