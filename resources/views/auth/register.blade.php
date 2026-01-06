@extends('layouts.app')

@section('title', 'Đăng Ký')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    {{-- Tiêu đề --}}
                    <div class="text-center mb-4">
                        <h2 class="mb-2">
                            <i class="fas fa-user-plus text-primary me-2"></i>Đăng Ký
                        </h2>
                        <p class="text-muted">Tạo tài khoản mới của bạn</p>
                    </div>

                    {{-- Hiển thị lỗi --}}
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

                    {{-- Form đăng ký --}}
                    <form action="{{ route('auth.register') }}" method="POST" novalidate>
                        @csrf

                        {{-- Tên --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user text-primary me-2"></i>Họ tên
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" placeholder="Nhập họ tên của bạn"
                                required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope text-primary me-2"></i>Email
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" placeholder="Nhập email của bạn"
                                required>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Mật khẩu --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock text-primary me-2"></i>Mật khẩu
                            </label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Nhập mật khẩu (tối thiểu 6 kỷ tự)" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-info-circle me-1"></i>Mật khẩu phải có ít nhất 6 ký tự
                            </small>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Xác nhận mật khẩu --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock text-primary me-2"></i>Xác nhận mật khẩu
                            </label>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Nhập lại mật khẩu" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Điều khoản --}}
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Tôi đồng ý với
                                <a href="#" class="text-primary text-decoration-none">điều khoản sử dụng</a>
                                và
                                <a href="#" class="text-primary text-decoration-none">chính sách bảo mật</a>
                            </label>
                        </div>

                        {{-- Nút đăng ký --}}
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mb-3">
                            <i class="fas fa-user-plus me-2"></i>Đăng Ký
                        </button>

                        {{-- Divider --}}
                        <div class="d-flex align-items-center mb-3">
                            <hr class="flex-grow-1">
                            <span class="mx-2 text-muted small">HOẶC</span>
                            <hr class="flex-grow-1">
                        </div>

                        {{-- Link đăng nhập --}}
                        <p class="text-center text-muted mb-0">
                            Đã có tài khoản?
                            <a href="{{ route('auth.login') }}" class="text-primary text-decoration-none fw-bold">
                                Đăng nhập
                            </a>
                        </p>
                    </form>

                </div>
            </div>

            {{-- Footer hỗ trợ --}}
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
    // Toggle password field
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const toggleButton = this;

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            toggleButton.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });

    // Toggle password confirmation field
    document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
        const passwordConfirmInput = document.getElementById('password_confirmation');
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
