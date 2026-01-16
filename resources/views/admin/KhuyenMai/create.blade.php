@extends('admin.layouts.app')

@section('content')
    <div class="container">

        <h4>Thêm khuyến mãi</h4>

        {{-- Hiển thị lỗi validate --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.khuyenmai.store') }}" method="POST">
            @csrf

            {{-- Tên khuyến mãi --}}
            <div class="mb-3">
                <label>Tên khuyến mãi</label>
                <input type="text" name="TenKM" class="form-control" value="{{ old('TenKM') }}" required>
            </div>

            {{-- Phần trăm giảm --}}
            <div class="mb-3">
                <label>Phần trăm giảm (%)</label>
                <input type="number" name="PhanTramGiam" class="form-control" min="1" max="100"
                    value="{{ old('PhanTramGiam') }}" required>
            </div>

            {{-- Ngày bắt đầu --}}
            <div class="mb-3">
                <label>Ngày bắt đầu</label>
                <input type="date" name="NgayBatDau" class="form-control" value="{{ old('NgayBatDau') }}" required>
            </div>

            {{-- Ngày kết thúc --}}
            <div class="mb-3">
                <label>Ngày kết thúc</label>
                <input type="date" name="NgayKetThuc" class="form-control" value="{{ old('NgayKetThuc') }}" required>
            </div>

            {{-- Trạng thái --}}
            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="TrangThai" class="form-select" required>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            {{-- Buttons --}}
            <button class="btn btn-primary">Lưu</button>

            <a href="{{ route('admin.khuyenmai.index') }}" class="btn btn-secondary">
                Quay lại
            </a>

        </form>

    </div>
@endsection
