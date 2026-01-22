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
                <a href="{{ url('/admin/san-pham') }}" class="sidebar-link">
                    <i class="bi bi-box-seam"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>



            <li class="sidebar-item">
                <a href="{{ url('/admin/thuong-hieu') }}" class="sidebar-link">
                    <i class="bi bi-building"></i>
                    <span>Thương hiệu</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/don-hang') }}" class="sidebar-link">
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
                <a href="{{ url('/admin/contacts') }}" class="sidebar-link">
                    <i class="bi bi-envelope"></i>
                    <span>Liên hệ</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ url('/admin/khuyen-mai') }}" class="sidebar-link">
                    <i class="bi bi-tags"></i>
                    <span>Khuyến mãi</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ url('/admin/nha-cung-cap') }}" class="sidebar-link">
                    <i class="bi bi-truck"></i>
                    <span>Nhà cung cấp</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.bai-viet.index') }}" class="sidebar-link">
                    <i class="bi bi-journal-text"></i>
                    <span>Bài viết</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.blog-category.index') }}" class="sidebar-link">
                    <i class="bi bi-folder2-open"></i>
                    <span>Danh mục Blog</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a href="{{ url('admin/company-info') }}" class="sidebar-link">
                    <i class="bi bi-gear"></i>
                    <span>Thông tin công ty</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('admin.policies.index') }}" class="sidebar-link">
                    <i class="bi bi-file-earmark-check"></i>
                    <span>Chính sách</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('admin.faqs.index') }}" class="sidebar-link">
                    <i class="bi bi-question-circle"></i>
                    <span>Câu hỏi thường gặp</span>
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
