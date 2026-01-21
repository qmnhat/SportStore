<div class="container-fluid nav-bar p-0">
    <div class="row gx-0 bg-primary px-5 align-items-center">
        <div class="col-lg-3 d-none d-lg-block">
            <nav class="navbar navbar-light position-relative" style="width: 250px;">
                <button class="navbar-toggler border-0 fs-4 w-100 px-0 text-start" type="button" data-bs-toggle="collapse"
                    data-bs-target="#allCat">
                    <h4 class="m-0"><i class="fa fa-bars me-2"></i>Danh mục</h4>
                </button>
                <div class="collapse navbar-collapse rounded-bottom" id="allCat">
                    <div class="navbar-nav ms-auto py-0">

                    </div>
                </div>
            </nav>
        </div>

        <div class="col-12 col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-light bg-primary">
                <a href="/" class="navbar-brand d-block d-lg-none">
                    <h1 class="display-5 text-secondary m-0">
                        <i class="fas fa-shopping-bag text-white me-2"></i>Electro
                    </h1>
                </a>

                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars fa-1x"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">
                            Trang chủ
                        </a>

                        <a href="/gioi-thieu"
                            class="nav-item nav-link {{ request()->is('gioi-thieu') ? 'active' : '' }}">
                            Giới thiệu
                        </a>

                        <a href="/san-pham" class="nav-item nav-link {{ request()->is('san-pham*') ? 'active' : '' }}">
                            Sản phẩm
                        </a>

                        <a href="/lien-he" class="nav-item nav-link {{ request()->is('lien-he') ? 'active' : '' }}">
                            Liên hệ
                        </a>

                        <a href="{{ route('blog.index') }}"
                            class="nav-item nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                            Bài viết
                        </a>
                        @if (session()->has('khachhang'))
                            <div class="nav-item dropdown ms-2">
                                <a href="#"
                                    class="nav-item nav-link dropdown-toggle
                                    {{ request()->is('thong-tin-ca-nhan') ||
                                    request()->is('don-hang*') ||
                                    request()->is('lich-su-mua-hang') ||
                                    request()->is('doi-mat-khau')
                                        ? 'active'
                                        : '' }}"
                                    data-bs-toggle="dropdown">
                                    <i class="fa fa-user me-1"></i>
                                    {{ session('khachhang.HoTen') }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end rounded shadow-sm">
                                    <a href="/thong-tin-ca-nhan"
                                        class="dropdown-item {{ request()->is('thong-tin-ca-nhan') ? 'active' : '' }}">
                                        Thông tin cá nhân
                                    </a>

                                    <a href="/don-hang"
                                        class="dropdown-item {{ request()->is('don-hang*') ? 'active' : '' }}">
                                        Đơn hàng
                                    </a>


                                    <a href="/gio-hang"
                                        class="dropdown-item {{ request()->is('gio-hang') ? 'active' : '' }}">
                                        Giỏ hàng
                                    </a>

                                    <a href="/doi-mat-khau"
                                        class="dropdown-item {{ request()->is('doi-mat-khau') ? 'active' : '' }}">
                                        Đổi mật khẩu
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a href="/dang-xuat" class="dropdown-item text-danger">
                                        Đăng xuất
                                    </a>
                                </div>
                            </div>
                        @else
                            <a href="/dang-nhap"
                                class="nav-link ms-2 {{ request()->is('dang-nhap') ? 'active' : '' }}">
                                <i class="fa fa-sign-in-alt me-1"></i> Đăng nhập
                            </a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
