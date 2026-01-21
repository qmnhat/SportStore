@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
    <div class="page-heading mb-4">
        <h3>Chỉnh sửa sản phẩm: {{ $sanpham->TenSP }}</h3>
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

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.sanpham.update', $sanpham->MaSP) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- Thông tin cơ bản --}}
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông tin cơ bản</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Mã sản phẩm</label>
                            <input type="text" class="form-control" value="{{ $sanpham->MaSP }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="TenSP" class="form-control @error('TenSP') is-invalid @enderror"
                                value="{{ old('TenSP', $sanpham->TenSP) }}" placeholder="Nhập tên sản phẩm" required>
                            @error('TenSP')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                                <select name="MaDM" class="form-select @error('MaDM') is-invalid @enderror" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($danhMucs as $dm)
                                        <option value="{{ $dm->MaDM }}"
                                            {{ old('MaDM', $sanpham->MaDM) == $dm->MaDM ? 'selected' : '' }}>
                                            {{ $dm->TenDM }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('MaDM')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thương hiệu <span class="text-danger">*</span></label>
                                <select name="MaTH" class="form-select @error('MaTH') is-invalid @enderror" required>
                                    <option value="">-- Chọn thương hiệu --</option>
                                    @foreach ($thuongHieus as $th)
                                        <option value="{{ $th->MaTH }}"
                                            {{ old('MaTH', $sanpham->MaTH) == $th->MaTH ? 'selected' : '' }}>
                                            {{ $th->TenTH }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('MaTH')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả sản phẩm</label>
                            <textarea name="MoTa" class="form-control @error('MoTa') is-invalid @enderror" rows="5"
                                placeholder="Nhập mô tả chi tiết sản phẩm">{{ old('MoTa', $sanpham->MoTa) }}</textarea>
                            @error('MoTa')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Biến thể sản phẩm --}}
                <div class="card mb-4">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-cubes me-2"></i>Biến thể sản phẩm (Kích thước & Giá)</h5>
                        <button type="button" class="btn btn-sm btn-light" id="addVariant">
                            <i class="fas fa-plus"></i> Thêm biến thể
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="variantContainer">
                            @forelse ($sanpham->bienThe as $index => $bienThe)
                                <div class="variant-row border rounded p-3 mb-3">
                                    <input type="hidden" name="bienthe[{{ $index }}][MaBT]" value="{{ $bienThe->MaBT }}">
                                    <div class="row align-items-end">
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Kích thước <span class="text-danger">*</span></label>
                                            <select name="bienthe[{{ $index }}][MaKT]" class="form-select" required>
                                                <option value="">-- Chọn --</option>
                                                @foreach ($kichThuocs as $kt)
                                                    <option value="{{ $kt->MaKT }}"
                                                        {{ $bienThe->MaKT == $kt->MaKT ? 'selected' : '' }}>
                                                        {{ $kt->TenKT }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Giá gốc (VNĐ) <span class="text-danger">*</span></label>
                                            <input type="number" name="bienthe[{{ $index }}][GiaGoc]" class="form-control"
                                                value="{{ $bienThe->GiaGoc }}" min="0" step="1000" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                                            <input type="number" name="bienthe[{{ $index }}][SoLuong]" class="form-control"
                                                value="{{ $bienThe->SoLuong }}" min="0" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <button type="button" class="btn btn-danger btn-remove-variant w-100"
                                                {{ count($sanpham->bienThe) <= 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                {{-- Nếu chưa có biến thể nào --}}
                                <div class="variant-row border rounded p-3 mb-3">
                                    <div class="row align-items-end">
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Kích thước <span class="text-danger">*</span></label>
                                            <select name="bienthe[0][MaKT]" class="form-select" required>
                                                <option value="">-- Chọn --</option>
                                                @foreach ($kichThuocs as $kt)
                                                    <option value="{{ $kt->MaKT }}">{{ $kt->TenKT }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Giá gốc (VNĐ) <span class="text-danger">*</span></label>
                                            <input type="number" name="bienthe[0][GiaGoc]" class="form-control"
                                                placeholder="0" min="0" step="1000" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                                            <input type="number" name="bienthe[0][SoLuong]" class="form-control"
                                                placeholder="0" min="0" required>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <button type="button" class="btn btn-danger btn-remove-variant w-100" disabled>
                                                <i class="fas fa-trash"></i> Xóa
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-info-circle"></i> Mỗi sản phẩm cần ít nhất 1 biến thể (kích thước + giá + số lượng)
                        </small>
                    </div>
                </div>

                {{-- Hình ảnh sản phẩm --}}
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-images me-2"></i>Hình ảnh sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        {{-- Hình ảnh hiện tại --}}
                        @if ($sanpham->hinhAnh && count($sanpham->hinhAnh) > 0)
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh hiện tại</label>
                                <div class="row g-2" id="currentImages">
                                    @foreach ($sanpham->hinhAnh as $hinh)
                                        <div class="col-4 col-md-3" id="image-{{ $hinh->MaHinh }}">
                                            <div class="position-relative">
                                                <img src="{{ asset($hinh->DuongDan) }}" class="img-fluid border rounded"
                                                    style="height: 100px; width: 100%; object-fit: cover;">
                                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                                    onclick="markImageDelete({{ $hinh->MaHinh }})" title="Xóa ảnh này">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                <input type="hidden" name="keep_images[]" value="{{ $hinh->MaHinh }}"
                                                    id="keep-{{ $hinh->MaHinh }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label class="form-label">Thêm hình ảnh mới</label>
                            <input type="file" name="HinhAnh[]" class="form-control" multiple accept="image/*"
                                id="imageInput">
                            <small class="text-muted">Có thể chọn nhiều hình. Định dạng: JPG, PNG, GIF. Tối đa 2MB/ảnh</small>
                        </div>
                        <div id="imagePreview" class="row g-2"></div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Trạng thái --}}
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Cài đặt</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="TrangThai" class="form-select">
                                <option value="1" {{ old('TrangThai', $sanpham->TrangThai) == 1 ? 'selected' : '' }}>
                                    Hoạt động
                                </option>
                                <option value="0" {{ old('TrangThai', $sanpham->TrangThai) == 0 ? 'selected' : '' }}>
                                    Ẩn
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="NoiBat" value="1"
                                    id="NoiBat" {{ old('NoiBat', $sanpham->NoiBat) ? 'checked' : '' }}>
                                <label class="form-check-label" for="NoiBat">
                                    <i class="fas fa-star text-warning"></i> Sản phẩm nổi bật
                                </label>
                            </div>
                            <small class="text-muted">Sản phẩm sẽ hiển thị ở trang chủ</small>
                        </div>
                    </div>
                </div>

                {{-- Nút hành động --}}
                <div class="card">
                    <div class="card-body d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Cập nhật sản phẩm
                        </button>
                        <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Thêm biến thể
        let variantIndex = {{ $sanpham->bienThe->count() > 0 ? $sanpham->bienThe->count() : 1 }};
        document.getElementById('addVariant').addEventListener('click', function() {
            const container = document.getElementById('variantContainer');
            const kichThuocOptions = `@foreach ($kichThuocs as $kt)<option value="{{ $kt->MaKT }}">{{ $kt->TenKT }}</option>@endforeach`;

            const newVariant = document.createElement('div');
            newVariant.className = 'variant-row border rounded p-3 mb-3';
            newVariant.innerHTML = `
                <div class="row align-items-end">
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Kích thước <span class="text-danger">*</span></label>
                        <select name="bienthe[${variantIndex}][MaKT]" class="form-select" required>
                            <option value="">-- Chọn --</option>
                            ${kichThuocOptions}
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Giá gốc (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" name="bienthe[${variantIndex}][GiaGoc]" class="form-control"
                            placeholder="0" min="0" step="1000" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                        <input type="number" name="bienthe[${variantIndex}][SoLuong]" class="form-control"
                            placeholder="0" min="0" required>
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="button" class="btn btn-danger btn-remove-variant w-100">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(newVariant);
            variantIndex++;
            updateRemoveButtons();
        });

        // Xóa biến thể
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-variant')) {
                const row = e.target.closest('.variant-row');
                row.remove();
                updateRemoveButtons();
            }
        });

        function updateRemoveButtons() {
            const rows = document.querySelectorAll('.variant-row');
            rows.forEach((row, index) => {
                const btn = row.querySelector('.btn-remove-variant');
                btn.disabled = rows.length <= 1;
            });
        }

        // Đánh dấu xóa hình ảnh
        function markImageDelete(imageId) {
            const imageDiv = document.getElementById('image-' + imageId);
            const keepInput = document.getElementById('keep-' + imageId);

            if (imageDiv && keepInput) {
                imageDiv.remove();
            }
        }

        // Xem trước hình ảnh mới
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            Array.from(e.target.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const col = document.createElement('div');
                    col.className = 'col-4 col-md-3';
                    col.innerHTML = `
                        <div class="position-relative">
                            <img src="${event.target.result}" class="img-fluid border rounded"
                                style="height: 100px; width: 100%; object-fit: cover;">
                            <span class="badge bg-success position-absolute top-0 start-0">Mới</span>
                        </div>
                    `;
                    preview.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

@endsection
