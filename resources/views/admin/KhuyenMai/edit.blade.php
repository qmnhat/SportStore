@extends('admin.layouts.app')

@section('title', 'Sửa khuyến mãi')

@section('content')

    <div class="page-heading mb-4">
        <h3>Sửa khuyến mãi: {{ $km->TenKM }}</h3>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.khuyenmai.update', $km->MaKM) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Tên khuyến mãi --}}
                <div class="mb-3">
                    <label class="form-label">Tên khuyến mãi</label>
                    <input type="text" name="TenKM" class="form-control" value="{{ old('TenKM', $km->TenKM) }}" required>
                </div>

                {{-- Phần trăm giảm --}}
                <div class="mb-3">
                    <label class="form-label">Phần trăm giảm (%)</label>
                    <input type="number" name="PhanTramGiam" class="form-control" min="1" max="100"
                        value="{{ old('PhanTramGiam', $km->PhanTramGiam) }}" required>
                </div>

                {{-- Ngày bắt đầu --}}
                <div class="mb-3">
                    <label class="form-label">Ngày bắt đầu</label>
                    <input type="date" name="NgayBatDau" class="form-control"
                        value="{{ old('NgayBatDau', $km->NgayBatDau?->format('Y-m-d')) }}" required>
                </div>

                {{-- Ngày kết thúc --}}
                <div class="mb-3">
                    <label class="form-label">Ngày kết thúc</label>
                    <input type="date" name="NgayKetThuc" class="form-control"
                        value="{{ old('NgayKetThuc', $km->NgayKetThuc?->format('Y-m-d')) }}" required>
                </div>

                {{-- Trạng thái --}}
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="TrangThai" class="form-select">
                        <option value="1" {{ $km->TrangThai ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="0" {{ !$km->TrangThai ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.khuyenmai.index') }}" class="btn btn-secondary">
                        Quay lại
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
