@extends('layouts.app')

@section('title', 'Đăng ký')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="mb-2">
                            <i class="fas fa-user-plus text-primary me-2"></i>Đăng ký
                        </h2>
                        <p class="text-muted">Tạo tài khoản mới của bạn</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-circle me-2"></i>Lỗi!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="/dang-ky" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="HoTen" class="form-label">
                                <i class="fas fa-user text-primary me-2"></i>Họ tên
                            </label>
                            <input type="text" class="form-control" id="HoTen" name="HoTen" value="{{ old('HoTen') }}" placeholder="Nhập họ tên của bạn" required>
                        </div>

                        <div class="mb-3">
                            <label for="SoDienThoai" class="form-label">
                                <i class="fas fa-phone text-primary me-2"></i>Số điện thoại
                            </label>
                            <input type="text" class="form-control" id="SoDienThoai" name="SoDienThoai" value="{{ old('SoDienThoai') }}" placeholder="Nhập số điện thoại">
                        </div>

                        <div class="mb-3">
                            <label for="DiaChi" class="form-label">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>Địa chỉ
                            </label>
                            <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="{{ old('DiaChi') }}" placeholder="Nhập địa chỉ">
                        </div>

                        <div class="mb-3">
                            <label for="NgaySinh" class="form-label">
                                <i class="fas fa-calendar text-primary me-2"></i>Ngày sinh
                            </label>
                            <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="{{ old('NgaySinh') }}">
                        </div>

                        <div class="mb-3">
                            <label for="Email" class="form-label">
                                <i class="fas fa-envelope text-primary me-2"></i>Email
                            </label>
                            <input type="email" class="form-control" id="Email" name="Email" value="{{ old('Email') }}" placeholder="Nhập email của bạn" required>
                        </div>

                        <div class="mb-3">
                            <label for="MatKhau" class="form-label">
                                <i class="fas fa-lock text-primary me-2"></i>Mật khẩu
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="MatKhau" name="MatKhau" placeholder="Nhập mật khẩu (tối thiểu 6 ký tự)" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="MatKhau_confirm" class="form-label">
                                <i class="fas fa-lock text-primary me-2"></i>Nhập lại mật khẩu
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="MatKhau_confirm" name="MatKhau_confirm" placeholder="Nhập lại mật khẩu" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mb-3">
                            <i class="fas fa-user-plus me-2"></i>Đăng ký
                        </button>

                        <div class="d-flex align-items-center mb-3">
                            <hr class="flex-grow-1">
                            <span class="mx-2 text-muted small">HOẶC</span>
                            <hr class="flex-grow-1">
                        </div>

                        <p class="text-center text-muted mb-0">
                            Đã có tài khoản?
                            <a href="/dang-nhap" class="text-primary text-decoration-none fw-bold">Đăng nhập</a>
                        </p>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3">
                <small class="text-muted">
                    Cần trợ giúp?
                    <a href="#" class="text-primary text-decoration-none">Liên hệ hỗ trợ</a>
                </small>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword')?.addEventListener('click', function () {
        const passwordInput = document.getElementById('MatKhau');
        const toggleButton = this;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    document.getElementById('togglePasswordConfirm')?.addEventListener('click', function () {
        const passwordConfirmInput = document.getElementById('MatKhau_confirm');
        const toggleButton = this;

        if (passwordConfirmInput.type === 'password') {
            passwordConfirmInput.type = 'text';
            toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordConfirmInput.type = 'password';
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
</script>

<style>
    .card {
        border-radius: 10px;
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-control:focus {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 107, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
</style>
@endsection
