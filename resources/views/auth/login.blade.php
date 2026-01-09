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

                        {{-- Hiển thị lỗi chung --}}
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="/dang-nhap">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="Email" class="form-control" value="{{ old('Email') }}"
                                    required>
                                @error('Email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="MatKhau" class="form-control" required>
                                @error('MatKhau')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
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
