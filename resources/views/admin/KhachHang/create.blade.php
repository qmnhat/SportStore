@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h4>Thêm khách hàng</h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.khachhang.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Họ tên</label>
                <input type="text" name="HoTen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="Email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mật khẩu</label>
                <input type="password" name="MatKhau" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="MatKhau_confirmation" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>SĐT</label>
                <input type="text" name="SDT" class="form-control">
            </div>

            <div class="mb-3">
                <label>Địa chỉ</label>
                <input type="text" name="DiaChi" class="form-control">
            </div>

            <div class="mb-3">
                <label>Ngày sinh</label>
                <input type="date" name="NgaySinh" class="form-control">
            </div>

            <button class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.khachhang.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
