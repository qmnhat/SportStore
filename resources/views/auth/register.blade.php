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

                        <form method="POST" action="#">
                            {{-- sau này đổi thành route register --}}

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Họ và tên</label>
                                    <input type="text" class="form-control" placeholder="Nguyễn Văn A" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" placeholder="0123456789" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" placeholder="Nhập địa chỉ" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ngày sinh</label>
                                <input type="date" class="form-control" required>
                            </div>

                            <hr>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="email@example.com" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/dang-nhap" class="btn btn-outline-secondary">
                                    Quay lại
                                </a>

                                <button class="btn btn-primary">
                                    Đăng ký
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
