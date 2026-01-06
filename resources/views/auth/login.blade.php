@extends('layouts.app')

@section('title', 'Đăng Nhập')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    {{-- Tiêu đề --}}
                    <div class="text-center mb-4">
                        <h2 class="mb-2">
                            <i class="fas fa-sign-in-alt text-primary me-2"></i>Đăng Nhập
                        </h2>
                        <p class="text-muted">Đăng nhập vào tài khoản của bạn</p>
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

                    {{-- Form đăng nhập --}}
                    <form action="{{ route('auth.login') }}" method="POST" novalidate>
                        @csrf

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
                                    id="password" name="password" placeholder="Nhập mật khẩu của bạn" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nút đăng nhập --}}
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mb-3">
                            <i class="fas fa-sign-in-alt me-2"></i>Đăng Nhập
                        </button>

                        {{-- Divider --}}
                        <div class="d-flex align-items-center mb-3">
                            <hr class="flex-grow-1">
                            <span class="mx-2 text-muted small">HOẶC</span>
                            <hr class="flex-grow-1">
                        </div>

                        {{-- Link đăng ký --}}
                        <p class="text-center text-muted mb-0">
                            Chưa có tài khoản?
                            <a href="{{ route('auth.register') }}" class="text-primary text-decoration-none fw-bold">
                                Đăng ký ngay
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
