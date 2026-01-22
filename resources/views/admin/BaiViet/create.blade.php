@extends('admin.layouts.app')
@section('title', 'Thêm bài viết')
@section('content')
    <div class="page-heading mb-4">
        <h3>Thêm bài viết mới</h3>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.baiviet.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" name="TieuDe" class="form-control @error('TieuDe') is-invalid @enderror"
                        value="{{ old('TieuDe') }}" required>
                    @error('TieuDe')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tóm tắt</label>
                    <textarea name="TomTat" class="form-control @error('TomTat') is-invalid @enderror" rows="3"
                        placeholder="Mô tả ngắn về bài viết...">{{ old('TomTat') }}</textarea>
                    @error('TomTat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                    <textarea name="NoiDung" rows="10" class="form-control @error('NoiDung') is-invalid @enderror" required>{{ old('NoiDung') }}</textarea>
                    @error('NoiDung')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Hình ảnh</label>
                    <input type="file" name="HinhAnh" class="form-control @error('HinhAnh') is-invalid @enderror"
                        accept="image/*">
                    <small class="form-text text-muted">Tối đa 2MB, định dạng: JPG, PNG, GIF</small>
                    @error('HinhAnh')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái <span class="text-danger">*</span></label>
                    <select name="TrangThai" class="form-select" required>
                        <option value="1" {{ old('TrangThai', 1) == 1 ? 'selected' : '' }}>Công khai</option>
                        <option value="0" {{ old('TrangThai') == 0 ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Lưu bài viết
                    </button>
                    <a href="{{ route('admin.baiviet.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
