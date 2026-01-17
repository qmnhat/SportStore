@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4">
                            <i class="fa fa-user-plus me-2"></i>Đăng ký tài khoản
                        </h4>
                        @if ($errors->any())
                        <div class="alert alert-danger" style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form method="POST" action="/dang-ky">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" name="HoTen" class="form-control" value="{{ old('HoTen') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Giới tính</label>
                                    <select name="GioiTinh" class="form-select">
                                        <option value="">-- Chọn --</option>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label" >Số điện thoại</label>
                                    <input type="text" name="SoDienThoai" class="form-control" value="{{ old('SoDienThoai') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" name="DiaChi" class="form-control" value="{{ old('DiaChi') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" name="NgaySinh" class="form-control" value="{{ old('NgaySinh') }}">
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="Email" class="form-control" value="{{ old('Email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="MatKhau" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" name="MatKhau_confirm" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/dang-nhap" class="btn btn-outline-secondary">Quay lại</a>
                                <button class="btn btn-primary">Đăng ký</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
