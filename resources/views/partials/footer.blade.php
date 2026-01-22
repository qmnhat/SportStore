<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5">

        {{-- Thông tin nhanh --}}
        <div class="row g-4 rounded mb-5" style="background: rgba(255, 255, 255, .03);">
            @if($company)
            {{-- Địa chỉ --}}
            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4 text-center">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 70px; height: 70px;">
                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="text-white mb-2">Địa chỉ</h5>
                        <p class="text-white-50 small mb-0">{{ $company->address ?? 'Quận 5, TP.HCM' }}</p>
                    </div>
                </div>
            </div>

            {{-- Hotline --}}
            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4 text-center">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 70px; height: 70px;">
                        <i class="fa fa-phone-alt fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="text-white mb-2">Hotline</h5>
                        <p class="text-white-50 small mb-0">
                            <a href="tel:{{ str_replace(' ', '', $company->hotline ?? '') }}" class="text-white-50 text-decoration-none">
                                {{ $company->hotline ?? '1900 888 999' }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4 text-center">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 70px; height: 70px;">
                        <i class="fas fa-envelope fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="text-white mb-2">Email</h5>
                        <p class="text-white-50 small mb-0">
                            <a href="mailto:{{ $company->email ?? '' }}" class="text-white-50 text-decoration-none">
                                {{ $company->email ?? 'support@sportstore.vn' }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Giờ hoạt động --}}
            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4 text-center">
                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 70px; height: 70px;">
                        <i class="fas fa-clock fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h5 class="text-white mb-2">Giờ mở cửa</h5>
                        <p class="text-white-50 small mb-0">{{ $company->opening_hours ?? '8:00 - 21:00' }}</p>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6 col-lg-3">
                <div class="rounded p-4 text-center">
                    <p class="text-white-50 small">Thông tin công ty đang được cập nhật</p>
                </div>
            </div>
            @endif
        </div>

        {{-- Nội dung footer chính --}}
        <div class="row g-5">

            {{-- Cột 1: Về công ty --}}
            <div class="col-md-6 col-lg-3">
                <div class="footer-item">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('img/logo.png') }}" style="height:40px" alt="SportStore">
                        <h5 class="text-primary mb-0">SportStore</h5>
                    </div>

                    @if($company)
                    <p class="text-white-50 small mb-4">
                        {{ $company->description ?? 'Chuyên cung cấp dụng cụ và thời trang thể thao chính hãng từ các thương hiệu hàng đầu thế giới.' }}
                    </p>

                    {{-- Mạng xã hội --}}
                    <h6 class="text-white mb-3">Kết nối với chúng tôi</h6>
                    <div class="d-flex gap-2">
                        @if($company->facebook_url)
                        <a class="btn btn-outline-light btn-sm rounded-circle" href="{{ $company->facebook_url }}" target="_blank" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        @endif
                        @if($company->instagram_url)
                        <a class="btn btn-outline-light btn-sm rounded-circle" href="{{ $company->instagram_url }}" target="_blank" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        @if($company->youtube_url)
                        <a class="btn btn-outline-light btn-sm rounded-circle" href="{{ $company->youtube_url }}" target="_blank" title="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                        @endif
                        @if($company->twitter_url)
                        <a class="btn btn-outline-light btn-sm rounded-circle" href="{{ $company->twitter_url }}" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        @endif
                    </div>
                    @else
                    <p class="text-white-50 small mb-4">
                        Chuyên cung cấp dụng cụ và thời trang thể thao chính hãng từ các thương hiệu hàng đầu thế giới.
                    </p>
                    @endif
                </div>
            </div>

            {{-- Cột 2: Danh mục --}}
            <div class="col-md-6 col-lg-2">
                <div class="footer-item">
                    <h5 class="text-primary mb-4">Danh mục</h5>
                    <a href="/" class="text-white-50 d-block mb-2">
                        <i class="fas fa-angle-right me-2"></i>Trang chủ
                    </a>
                    <a href="/san-pham" class="text-white-50 d-block mb-2">
                        <i class="fas fa-angle-right me-2"></i>Sản phẩm
                    </a>
                    <a href="/gioi-thieu" class="text-white-50 d-block mb-2">
                        <i class="fas fa-angle-right me-2"></i>Giới thiệu
                    </a>
                    <a href="/lien-he" class="text-white-50 d-block">
                        <i class="fas fa-angle-right me-2"></i>Liên hệ
                    </a>
                </div>
            </div>

            {{-- Cột 3: Chính sách --}}
            <div class="col-md-6 col-lg-3">
                <div class="footer-item">
                    <h5 class="text-primary mb-4">Chính sách & Hỗ trợ</h5>
                    <a href="#" class="text-white-50 d-block mb-2">
                        <i class="fas fa-angle-right me-2"></i>Chính sách giao hàng
                    </a>
                    <a href="#" class="text-white-50 d-block mb-2">
                        <i class="fas fa-angle-right me-2"></i>Chính sách đổi trả
                    </a>
                    <a href="#" class="text-white-50 d-block mb-2">
                        <i class="fas fa-angle-right me-2"></i>Chính sách bảo mật
                    </a>
                    <a href="#" class="text-white-50 d-block mb-2">
                        <i class="fas fa-angle-right me-2"></i>Điều khoản dịch vụ
                    </a>
                    <a href="#" class="text-white-50 d-block">
                        <i class="fas fa-angle-right me-2"></i>Câu hỏi thường gặp
                    </a>
                </div>
            </div>

            {{-- Cột 4: Thông tin bổ sung --}}
            <div class="col-md-6 col-lg-3">
                <div class="footer-item">
                    <h5 class="text-primary mb-4">Thông tin công ty</h5>
                    @if($company)
                    <ul class="list-unstyled small text-white-50">
                        @if($company->name)
                        <li class="mb-2">
                            <strong class="text-white">Công ty:</strong><br>
                            {{ $company->name }}
                        </li>
                        @endif
                        @if($company->tax_code)
                        <li class="mb-2">
                            <strong class="text-white">Mã số thuế:</strong><br>
                            {{ $company->tax_code }}
                        </li>
                        @endif
                        @if($company->employee_count)
                        <li class="mb-2">
                            <strong class="text-white">Nhân viên:</strong><br>
                            Khoảng {{ $company->employee_count }}+ người
                        </li>
                        @endif
                        @if($company->zalo_phone)
                        <li>
                            <strong class="text-white">Zalo:</strong><br>
                            <a href="tel:{{ str_replace(' ', '', $company->zalo_phone) }}" class="text-white-50 text-decoration-none">
                                {{ $company->zalo_phone }}
                            </a>
                        </li>
                        @endif
                    </ul>
                    @else
                    <p class="text-white-50 small">Thông tin công ty đang được cập nhật</p>
                    @endif
                </div>
            </div>

        </div>

        {{-- Đường phân cách --}}
        <hr class="my-5" style="opacity: 0.2;">

        {{-- Footer dưới cùng --}}
        <div class="row">
            <div class="col-md-6">
                <p class="text-white-50 small mb-0">
                    &copy; 2025 <strong class="text-primary">SportStore</strong>. Tất cả quyền được bảo lưu.
                </p>
            </div>
            <div class="col-md-6 text-end">
                <p class="text-white-50 small mb-0">
                    Thiết kế bởi <strong class="text-primary">SportStore Team</strong>
                </p>
            </div>
        </div>

    </div>
</div>
<!-- Footer End -->
