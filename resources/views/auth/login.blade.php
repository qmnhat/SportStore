@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4">
                            <i class="fa fa-sign-in-alt me-2"></i>Đăng nhập
                        </h4>

                        <form method="POST" action="#">
                            {{-- sau này đổi thành route login --}}

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Nhập email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" required>
                            </div>

                            <div class="d-grid mb-3">
                                <button class="btn btn-primary">
                                    Đăng nhập
                                </button>
                            </div>

                            <div class="text-center">
                                <small>
                                    Chưa có tài khoản?
                                    <a href="/dang-ky">Đăng ký</a>
                                </small>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
