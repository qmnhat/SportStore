@extends('admin.layouts.app')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
    <div class="page-heading mb-4">
        <h3>Chỉnh sửa sản phẩm</h3>
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
            <form action="{{ route('admin.sanpham.update', $sanpham->MaSP) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Mã sản phẩm</label>
                    <input type="text" class="form-control" value="{{ $sanpham->MaSP }}" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input type="text" name="TenSP" class="form-control @error('TenSP') is-invalid @enderror"
                        value="{{ old('TenSP', $sanpham->TenSP) }}" required>
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
                    <label class="form-label">Mô tả</label>
                    <textarea name="MoTa" class="form-control @error('MoTa') is-invalid @enderror" rows="4">{{ old('MoTa', $sanpham->MoTa) }}</textarea>
                    @error('MoTa')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="TrangThai" class="form-select">
                        <option value="1" {{ old('TrangThai', $sanpham->TrangThai) == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ old('TrangThai', $sanpham->TrangThai) == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Cập nhật sản phẩm
                    </button>
                    <a href="{{ route('admin.sanpham.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
