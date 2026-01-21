@extends('admin.layouts.app')

@section('title', 'Sửa kích thước')

@section('content')
    <div class="page-heading mb-4">
        <h3>Sửa kích thước: {{ $kichThuoc->TenKT }}</h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sửa thông tin kích thước</h5>
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

                    <form action="{{ route('admin.kichthuoc.update', $kichThuoc->MaKT) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">
                                <strong>Tên kích thước <span class="text-danger">*</span></strong>
                            </label>
                            <input type="text" name="TenKT" class="form-control @error('TenKT') is-invalid @enderror"
                                value="{{ old('TenKT', $kichThuoc->TenKT) }}" placeholder="VD: S, M, L, XL, 39, 40, 41..." required>
                            @error('TenKT')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Số sản phẩm đang sử dụng</strong></label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-info">{{ $kichThuoc->bienThes()->count() }} sản phẩm</span>
                            </p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kichthuoc.index') }}" class="btn btn-secondary">
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
