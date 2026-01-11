@extends('layouts.app') {{-- Giả sử bạn dùng layout chính là layouts.app --}}

@section('title', 'Thông tin công ty')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">

            {{-- 1. GIỚI THIỆU CHUNG --}}
            <div class="mb-5 text-center">
                <h1 class="display-4 fw-bold text-primary">Giới thiệu về SportStore</h1>
                <p class="lead text-muted">Đồng hành cùng đam mê thể thao của bạn từ năm 2025</p>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">1. Hồ sơ doanh nghiệp</h3>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><strong>Tên đơn vị:</strong> CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ SPORTSTORE VIỆT NAM</li>
                        <li class="mb-2"><strong>Trụ sở chính:</strong> Số 123, Đường Nguyễn Văn Cừ, Phường 5, Quận 5, TP. Hồ Chí Minh</li>
                        <li class="mb-2"><strong>Showroom:</strong> Tầng 2, Tòa nhà SportComplex, Quận 1, TP.HCM</li>
                        <li class="mb-2"><strong>Hotline:</strong> 1900 888 999 (Hỗ trợ 24/7)</li>
                        <li class="mb-2"><strong>Email:</strong> support@sportstore.vn</li>
                        <li class="mb-2"><strong>Mã số thuế:</strong> 0316xxxxxx</li>
                        <li><strong>Lĩnh vực kinh doanh:</strong>
                            <ul>
                                <li>Bán lẻ dụng cụ thể thao chuyên nghiệp (Bóng đá, Gym, Yoga, Cầu lông...).</li>
                                <li>Phân phối chính hãng giày và thời trang thể thao.</li>
                                <li>Tư vấn thiết kế phòng tập gia đình.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 2. TẦM NHÌN & SỨ MỆNH --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h4 class="text-primary"><i class="bi bi-eye"></i> Tầm nhìn</h4>
                            <p>Trở thành hệ thống bán lẻ đồ thể thao số 1 tại Việt Nam, mang đến trải nghiệm mua sắm tiện lợi và hiện đại nhất cho người yêu vận động.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light">
                        <div class="card-body">
                            <h4 class="text-primary"><i class="bi bi-flag"></i> Sứ mệnh</h4>
                            <p>SportStore không chỉ bán sản phẩm, chúng tôi bán "sức khỏe" và "phong cách sống". Cam kết 100% sản phẩm chính hãng, chất lượng vượt trội.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. CHÍNH SÁCH KHÁCH HÀNG (QUAN TRỌNG CHO E-COMMERCE) --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">2. Chính sách & Cam kết</h3>

                    <div class="mt-3">
                        <h5 class="fw-bold text-dark">🚚 Chính sách vận chuyển</h5>
                        <ul>
                            <li>Miễn phí giao hàng cho đơn hàng từ <strong>500.000đ</strong> trở lên.</li>
                            <li>Giao hàng hỏa tốc 2H trong nội thành TP.HCM và Hà Nội.</li>
                            <li>Được kiểm tra hàng trước khi thanh toán (COD).</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h5 class="fw-bold text-dark">🔄 Chính sách đổi trả - Bảo hành</h5>
                        <ul>
                            <li><strong>Đổi trả 1-1 trong 30 ngày:</strong> Nếu sản phẩm có lỗi từ nhà sản xuất hoặc không vừa size.</li>
                            <li><strong>Bảo hành chính hãng:</strong> Từ 6 tháng đến 12 tháng tùy loại dụng cụ/thiết bị.</li>
                            <li>Hoàn tiền 200% nếu phát hiện hàng giả, hàng nhái.</li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <h5 class="fw-bold text-dark">🔒 Chính sách bảo mật</h5>
                        <p class="small text-muted">Chúng tôi cam kết bảo mật tuyệt đối thông tin cá nhân của khách hàng theo quy định của pháp luật Việt Nam. Thông tin của quý khách chỉ được sử dụng cho mục đích xử lý đơn hàng và chăm sóc khách hàng.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
