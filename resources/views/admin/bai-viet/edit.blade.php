@extends('admin.layouts.app')

@section('title', 'Sửa Bài Viết')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sửa Bài Viết: {{ $baiViet->TieuDe }}</h5>
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

                    <form action="{{ route('admin.bai-viet.update', $baiViet->MaBV) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-lg-8">
                                {{-- Tiêu đề --}}
                                <div class="mb-3">
                                    <label for="TieuDe" class="form-label">
                                        <strong>Tiêu đề <span class="text-danger">*</span></strong>
                                    </label>
                                    <input type="text" class="form-control @error('TieuDe') is-invalid @enderror"
                                        id="TieuDe" name="TieuDe" value="{{ old('TieuDe', $baiViet->TieuDe) }}"
                                        placeholder="Nhập tiêu đề bài viết" required>
                                    @error('TieuDe')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Slug --}}
                                <div class="mb-3">
                                    <label for="slug" class="form-label">
                                        <strong>Slug (URL)</strong>
                                    </label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ $baiViet->slug }}" readonly>
                                    <small class="text-muted">Tự động tạo từ tiêu đề</small>
                                </div>

                                {{-- Tóm tắt --}}
                                <div class="mb-3">
                                    <label for="TomTat" class="form-label">
                                        <strong>Tóm tắt <span class="text-danger">*</span></strong>
                                    </label>
                                    <textarea class="form-control @error('TomTat') is-invalid @enderror"
                                        id="TomTat" name="TomTat" rows="3" placeholder="Nhập tóm tắt bài viết" required>{{ old('TomTat', $baiViet->TomTat) }}</textarea>
                                    @error('TomTat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Nội dung --}}
                                <div class="mb-3">
                                    <label for="NoiDung" class="form-label">
                                        <strong>Nội dung <span class="text-danger">*</span></strong>
                                    </label>
                                    <textarea class="form-control @error('NoiDung') is-invalid @enderror"
                                        id="NoiDung" name="NoiDung" rows="8" placeholder="Nhập nội dung bài viết" required>{{ old('NoiDung', $baiViet->NoiDung) }}</textarea>
                                    @error('NoiDung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                {{-- Danh mục --}}
                                <div class="mb-3">
                                    <label for="MaDanhMuc" class="form-label">
                                        <strong>Danh mục <span class="text-danger">*</span></strong>
                                    </label>
                                    <select class="form-select @error('MaDanhMuc') is-invalid @enderror"
                                        id="MaDanhMuc" name="MaDanhMuc" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        @forelse($categories as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('MaDanhMuc', $baiViet->MaDanhMuc) == $cat->id)>{{ $cat->TenDanhMuc }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('MaDanhMuc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Hình ảnh --}}
                                <div class="mb-3">
                                    <label for="HinhAnh" class="form-label">
                                        <strong>Hình ảnh</strong>
                                    </label>

                                    @if($baiViet->HinhAnh)
                                    <div class="mb-2">
                                        <img src="{{ asset($baiViet->HinhAnh) }}" alt="{{ $baiViet->TieuDe }}"
                                            class="img-fluid border rounded" style="max-height: 200px;">
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" id="deleteImage" name="delete_image" value="1">
                                            <label class="form-check-label" for="deleteImage">
                                                Xóa hình ảnh hiện tại
                                            </label>
                                        </div>
                                    </div>
                                    @endif

                                    <input type="file" class="form-control @error('HinhAnh') is-invalid @enderror"
                                        id="HinhAnh" name="HinhAnh" accept="image/*">
                                    <small class="text-muted">Định dạng: JPG, PNG, GIF. Dung lượng tối đa: 5MB</small>
                                    @error('HinhAnh')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    <div id="imagePreview" class="mt-2"></div>
                                </div>

                                {{-- Trạng thái --}}
                                <div class="mb-3">
                                    <label class="form-label">
                                        <strong>Trạng thái</strong>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="TrangThai1"
                                            name="TrangThai" value="1" @checked(old('TrangThai', $baiViet->TrangThai) == 1)>
                                        <label class="form-check-label" for="TrangThai1">
                                            Công khai
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="TrangThai0"
                                            name="TrangThai" value="0" @checked(old('TrangThai', $baiViet->TrangThai) == 0)>
                                        <label class="form-check-label" for="TrangThai0">
                                            Nháp
                                        </label>
                                    </div>
                                </div>

                                {{-- Thông tin --}}
                                <div class="mb-3 p-3 bg-light rounded">
                                    <p class="mb-1"><strong>Lượt xem:</strong> {{ $baiViet->LuotXem ?? 0 }}</p>
                                    <p class="mb-1"><strong>Tác giả:</strong> {{ $baiViet->author?->name ?? 'N/A' }}</p>
                                    <p class="mb-0"><strong>Ngày tạo:</strong> {{ $baiViet->NgayTao?->format('d/m/Y H:i') ?? 'N/A' }}</p>
                                </div>

                                {{-- Nút hành động --}}
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Cập Nhật
                                    </button>
                                    <a href="{{ route('admin.bai-viet.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Hủy
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Xem trước hình ảnh
document.getElementById('HinhAnh')?.addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if (e.target.files && e.target.files[0]) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            img.classList.add('img-fluid', 'border', 'rounded');
            preview.appendChild(img);
        };
        reader.readAsDataURL(e.target.files[0]);
    }
});
</script>
@endsection
