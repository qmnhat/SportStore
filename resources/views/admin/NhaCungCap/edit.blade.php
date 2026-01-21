@extends('admin.layouts.app')

@section('title', 'Cập nhật nhà cung cấp')

@section('content')

    <div class="page-heading mb-4">
        <h3>Cập nhật nhà cung cấp</h3>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ url('/admin/nha-cung-cap/update/' . $ncc->MaNCC) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Tên nhà cung cấp</label>
                    <input type="text" name="TenNCC" class="form-control" value="{{ $ncc->TenNCC }}" required>
                </div>

                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <input type="text" name="DiaChi" class="form-control" value="{{ $ncc->DiaChi }}">
                </div>

                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="SDT" class="form-control" value="{{ $ncc->SDT }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="Email" class="form-control" value="{{ $ncc->Email }}">
                </div>

                <div class="mb-3">
                    <label>Trạng thái</label>
                    <select name="TrangThai" class="form-select">
                        <option value="1" {{ $ncc->TrangThai == 1 ? 'selected' : '' }}>Hoạt động</option>
                        <option value="0" {{ $ncc->TrangThai == 0 ? 'selected' : '' }}>Ngưng</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ url('/admin/nha-cung-cap') }}" class="btn btn-secondary">
                        Quay lại
                    </a>
                    <button class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>

            </form>

        </div>
    </div>

@endsection
