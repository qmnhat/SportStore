@php
    $admin = Auth::guard('admin')->user();
@endphp

<nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
    <div class="container-fluid">

        {{-- Toggle sidebar (mobile) --}}
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>

        {{-- Title --}}
        <div class="ms-3">
            <h6 class="mb-0 fw-bold">Hệ thống quản lý SportStore</h6>
        </div>

        {{-- User --}}
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-md me-2">
                            <i class="bi bi-person-circle fs-4"></i>
                        </div>
                        <div class="text-start d-none d-md-block">
                            <div class="fw-bold">
                                {{ $admin->HoTen ?? 'Admin' }}
                            </div>
                            <small class="text-muted">
                                {{ $admin->VaiTro == 1 ? 'Quản trị viên' : 'Nhân viên' }}
                            </small>
                        </div>
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>

            </li>
        </ul>

    </div>
</nav>
