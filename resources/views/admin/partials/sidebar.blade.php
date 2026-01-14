<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="{{ url('/admin/dashboard') }}">
                    <h5 class="mb-0">ADMIN PANEL</h5>
                </a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block">
                    <i class="bi bi-x bi-middle"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="sidebar-menu">
        <ul class="menu">

            <li class="sidebar-title">Dashboard</li>

            <li class="sidebar-item active">
                <a href="{{ url('/admin/dashboard') }}" class="sidebar-link">
                    <i class="bi bi-grid-fill"></i>
                    <span>Trang tổng quan</span>
                </a>
            </li>

            <li class="sidebar-title">Quản lý</li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/CSanPham') }}" class="sidebar-link">
                    <i class="bi bi-box-seam"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/CDanhMuc') }}" class="sidebar-link">
                    <i class="bi bi-list-ul"></i>
                    <span>Danh mục</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/thuong-hieu') }}" class="sidebar-link">
                    <i class="bi bi-building"></i>
                    <span>Thương hiệu</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/CDonHang') }}" class="sidebar-link">
                    <i class="bi bi-receipt"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/khach-hang') }}" class="sidebar-link">
                    <i class="bi bi-people"></i>
                    <span>Khách hàng</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/khuyen-mai') }}" class="sidebar-link">
                    <i class="bi bi-tags"></i>
                    <span>Khuyến mãi</span>
                </a>
            </li>

            <li class="sidebar-title">Khác</li>

            <li class="sidebar-item">
                <a href="{{ url('/') }}" class="sidebar-link">
                    <i class="bi bi-arrow-left"></i>
                    <span>Về trang bán</span>
                </a>
            </li>

        </ul>
    </div>
</div>
