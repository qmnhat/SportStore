@extends('admin.layouts.app')

@section('title', 'Thêm nhà cung cấp')

@section('content')

    <div class="page-heading mb-4">
        <h3>Thêm nhà cung cấp</h3>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ url('/admin/nha-cung-cap/store') }}" method="POST">
                @csrf

                {{-- Tên NCC --}}
                <div class="mb-3">
                    <label class="form-label">Tên nhà cung cấp</label>
                    <input type="text" name="TenNCC" class="form-control" required>
                </div>

                {{-- Địa chỉ --}}
                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <input type="text" name="DiaChi" class="form-control">
                </div>

                {{-- SĐT --}}
                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="SDT" class="form-control">
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="Email" class="form-control">
                </div>

                {{-- Trạng thái --}}
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="TrangThai" class="form-select">
                        <option value="1">Hoạt động</option>
                        <option value="0">Ngưng hoạt động</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ url('/admin/nha-cung-cap') }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>

            </form>

        </div>
    </div>

@endsection
