
@extends('layouts.app')

@section('title', 'Thông tin công ty - SportStore')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">

            {{-- 1. GIỚI THIỆU CHUNG --}}
            <div class="mb-5 text-center">
                <h1 class="display-4 fw-bold text-primary">Giới thiệu về SportStore</h1>
                <p class="lead text-muted">Đồng hành cùng đam mê thể thao của bạn từ năm 2025</p>
            </div>

            {{-- 2. HỒ SƠ DOANH NGHIỆP --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-building"></i> Hồ sơ doanh nghiệp
                    </h3>
                    <ul class="list-unstyled mt-3">
                        <li class="mb-2"><strong>📋 Tên đơn vị:</strong> {{ $company->name }}</li>
                        <li class="mb-2"><strong>📍 Trụ sở chính:</strong> {{ $company->address }}</li>
                        <li class="mb-2"><strong>🏬 Showroom chính:</strong> Tầng 2, Tòa nhà SportComplex, Quận 1, TP.HCM</li>
                        <li class="mb-2"><strong>📞 Hotline:</strong> {{ $company->hotline }} (Hỗ trợ 24/7)</li>
                        <li class="mb-2"><strong>📧 Email:</strong> {{ $company->email }}</li>
                        <li class="mb-2"><strong>🔢 Mã số thuế:</strong> {{ $company->tax_code }}</li>
                        <li class="mb-2"><strong>📅 Thời gian hoạt động:</strong> {{ $company->opening_hours }}</li>
                        <li><strong>🎯 Lĩnh vực kinh doanh chính:</strong>
                            <ul class="mt-2">
                                <li>Bán lẻ dụng cụ thể thao chuyên nghiệp (Bóng đá, Gym, Yoga, Cầu lông, Bóng bàn, Badminton...).</li>
                                <li>Phân phối chính hãng giày và thời trang thể thao từ các thương hiệu quốc tế.</li>
                                <li>Tư vấn thiết kế phòng tập gia đình & công ty.</li>
                                <li>Cho thuê dụng cụ thể thao cho sự kiện, giải đấu.</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- 3. TẦM NHÌN & SỨ MỆNH --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light shadow-sm">
                        <div class="card-body">
                            <h4 class="text-primary"><i class="bi bi-eye"></i> Tầm nhìn</h4>
                            <p>{{ $company->vision }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 border-0 bg-light shadow-sm">
                        <div class="card-body">
                            <h4 class="text-primary"><i class="bi bi-flag"></i> Sứ mệnh</h4>
                            <p>{{ $company->mission }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. LỢI THẾ CẠNH TRANH --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-trophy"></i> Lợi thế cạnh tranh
                    </h3>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3" style="font-size: 24px;"><i class="bi bi-patch-check"></i></div>
                                <div>
                                    <h6 class="fw-bold">100% Sản phẩm chính hãng</h6>
                                    <p class="small text-muted mb-0">Cam kết hoàn tiền 200% nếu phát hiện hàng giả.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3" style="font-size: 24px;"><i class="bi bi-lightning-fill"></i></div>
                                <div>
                                    <h6 class="fw-bold">Giao hàng siêu tốc</h6>
                                    <p class="small text-muted mb-0">2H giao hàng nội thành TP.HCM & Hà Nội.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3" style="font-size: 24px;"><i class="bi bi-person-hearts"></i></div>
                                <div>
                                    <h6 class="fw-bold">Hỗ trợ khách hàng 24/7</h6>
                                    <p class="small text-muted mb-0">Đội tư vấn chuyên nghiệp luôn sẵn sàng giúp đỡ.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex">
                                <div class="text-primary me-3" style="font-size: 24px;"><i class="bi bi-currency-dollar"></i></div>
                                <div>
                                    <h6 class="fw-bold">Giá cạnh tranh nhất</h6>
                                    <p class="small text-muted mb-0">Giảm giá 5-10% cho hội viên và khách hàng thân thiết.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. LỊCH SỬ & THÀNH TỰU --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-award"></i> Lịch sử & Thành tựu
                    </h3>
                    <div class="timeline mt-3">
                        <div class="mb-4 d-flex">
                            <div class="text-primary fw-bold me-3" style="min-width: 80px;">2025</div>
                            <div>
                                <h6 class="fw-bold">Thành lập SportStore</h6>
                                <p class="small text-muted mb-0">Khởi đầu với cơ sở duy nhất tại TP. Hồ Chí Minh.</p>
                            </div>
                        </div>
                        <div class="mb-4 d-flex">
                            <div class="text-primary fw-bold me-3" style="min-width: 80px;">2025</div>
                            <div>
                                <h6 class="fw-bold">Đạt 10,000 khách hàng</h6>
                                <p class="small text-muted mb-0">Trong 9 tháng đầu tiên, trở thành điểm tin cậy của các vận động viên.</p>
                            </div>
                        </div>
                        <div class="mb-4 d-flex">
                            <div class="text-primary fw-bold me-3" style="min-width: 80px;">2026</div>
                            <div>
                                <h6 class="fw-bold">Mở rộng chi nhánh Hà Nội</h6>
                                <p class="small text-muted mb-0">Kế hoạch mở showroom thứ 2 tại Hà Nội (Q1/2026).</p>
                            </div>
                        </div>
                        <div class="mb-4 d-flex">
                            <div class="text-primary fw-bold me-3" style="min-width: 80px;">2026</div>
                            <div>
                                <h6 class="fw-bold">Nhận chứng chỉ ISO 9001</h6>
                                <p class="small text-muted mb-0">Cam kết chất lượng dịch vụ quốc tế.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 6. ĐỘI NGŨ & TỔNG CHỨC --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-people"></i> Đội ngũ & Tổ chức
                    </h3>
                    <p class="mt-3">SportStore tự hào sở hữu một đội ngũ chuyên nghiệp, tàn tạo và tận tâm:</p>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold text-primary">50+ nhân viên</h6>
                                <p class="small mb-0">Từ kinh tế, bán hàng đến kỹ thuật và dịch vụ khách hàng.</p>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold text-primary">Đối tác quốc tế</h6>
                                <p class="small mb-0">Hợp tác với Nike, Adidas, Puma, Decathlon...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 7. CHÍNH SÁCH & CAM KẾT --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-file-earmark-check"></i> Chính sách & Cam kết
                    </h3>

                    <div class="mt-4">
                        <h5 class="fw-bold text-dark"><i class="bi bi-truck"></i> Chính sách vận chuyển</h5>
                        <ul class="mt-2">
                            <li>Miễn phí giao hàng cho đơn hàng từ <strong>500.000đ</strong> trở lên.</li>
                            <li>Giao hàng hỏa tốc 2H trong nội thành TP.HCM và Hà Nội.</li>
                            <li>Giao hàng tiêu chuẩn (3-5 ngày) cho các tỉnh khác.</li>
                            <li>Được kiểm tra hàng trước khi thanh toán (COD).</li>
                            <li>Bảo hiểm vận chuyển toàn bộ hàng hoá.</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold text-dark"><i class="bi bi-cash-coin"></i> Chính sách thanh toán</h5>
                        <ul class="mt-2">
                            <li><strong>Thanh toán khi nhận hàng (COD):</strong> Không tính phí, miễn phí.</li>
                            <li><strong>Chuyển khoản ngân hàng:</strong> Không tính phí, miễn phí.</li>
                            <li><strong>Ví điện tử:</strong> Momo, Zalo Pay, AirPay.</li>
                            {{-- <li><strong>Thẻ tín dụng/ghi nợ:</strong> Linh hoạt, không lãi suất.</li>
                            <li><strong>Mua trả góp:</strong> Qua ứng dụng tài chính (0% lãi).</li> --}}
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold text-dark"><i class="bi bi-arrow-repeat"></i> Chính sách đổi trả - Bảo hành</h5>
                        <ul class="mt-2">
                            <li><strong>Đổi trả 1-1 trong 30 ngày:</strong> Nếu sản phẩm có lỗi từ nhà sản xuất hoặc không vừa size.</li>
                            <li><strong>Bảo hành chính hãng:</strong> Từ 6 tháng đến 24 tháng tùy loại dụng cụ.</li>
                            <li><strong>Bảo hành mở rộng:</strong> Có thể mua bảo hành thêm 12 tháng.</li>
                            <li>Hoàn tiền 200% nếu phát hiện hàng giả, hàng nhái (không cần lý do).</li>
                            <li>Dịch vụ bảo trì miễn phí cho thiết bị thể thao trong 1 năm.</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h5 class="fw-bold text-dark"><i class="bi bi-shield-lock"></i> Chính sách bảo mật</h5>
                        <p class="small text-muted mt-2">Chúng tôi cam kết bảo mật tuyệt đối thông tin cá nhân của khách hàng theo quy định của pháp luật Việt Nam. Thông tin của quý khách chỉ được sử dụng cho mục đích xử lý đơn hàng, chăm sóc khách hàng và gửi thông tin khuyến mãi (có thể hủy bất cứ lúc nào). Chúng tôi sử dụng mã hóa SSL 256-bit cho tất cả giao dịch trực tuyến.</p>
                    </div>

                    {{-- <div class="mt-4">
                        <h5 class="fw-bold text-dark"><i class="bi bi-percent"></i> Chính sách khách hàng thân thiết</h5>
                        <ul class="mt-2">
                            <li>Tích điểm cho mỗi lần mua hàng (1đ = 1 điểm).</li>
                            <li>Giảm giá 5% với hội viên vàng, 10% với hội viên bạch kim.</li>
                            <li>Ưu tiên mua hàng mới, giảm giá mùa bán hàng.</li>
                            <li>Tặng quà sinh nhật hàng năm.</li>
                        </ul>
                    </div> --}}
                </div>
            </div>

            {{-- 8. ĐÁ GIÁP & TÂM TƯỞNG KHÁCH HÀNG --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-star"></i> Đánh giá khách hàng
                    </h3>
                    <div class="row mt-3">
                        <div class="col-md-4 text-center mb-3">
                            <h3 class="text-warning fw-bold">4.8/5.0</h3>
                            <p class="small text-muted">Điểm đánh giá trung bình</p>
                            <small class="text-warning">★★★★★</small>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <h3 class="text-success fw-bold">10,000+</h3>
                            <p class="small text-muted">Khách hàng hài lòng</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <h3 class="text-info fw-bold">98%</h3>
                            <p class="small text-muted">Tỷ lệ khách hàng quay lại</p>
                        </div>
                    </div>
                    <div class="mt-3 border-top pt-3">
                        <p class="small text-muted"><strong>Tâm tưởng:</strong> <em>"Không chỉ bán hàng, chúng tôi tạo dựng các mối quan hệ dài hạn với khách hàng bằng chất lượng, dịch vụ và sự tôn trọng."</em></p>
                    </div>
                </div>
            </div>

            {{-- 9. HỢP TÁC KINH DOANH --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-handshake"></i> Hợp tác kinh doanh
                    </h3>
                    <p class="mt-3">SportStore vinh dự là đối tác chính thức của các thương hiệu hàng đầu thế giới:</p>
                    <div class="row mt-3">
                        <div class="col-md-3 col-sm-6 text-center mb-3">
                            <div class="bg-light p-3 rounded">
                                <p class="fw-bold small">Nike</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center mb-3">
                            <div class="bg-light p-3 rounded">
                                <p class="fw-bold small">Adidas</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center mb-3">
                            <div class="bg-light p-3 rounded">
                                <p class="fw-bold small">Puma</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center mb-3">
                            <div class="bg-light p-3 rounded">
                                <p class="fw-bold small">Decathlon</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center mb-3">
                            <div class="bg-light p-3 rounded">
                                <p class="fw-bold small">New Balance</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 text-center mb-3">
                            <div class="bg-light p-3 rounded">
                                <p class="fw-bold small">Mizuno</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 small text-muted">Đang phát triển các hợp tác chiến lược với các nhãn hàng địa phương và quốc tế khác.</p>
                </div>
            </div>

            {{-- 10. LIÊN HỆ & MẠNG XÃ HỘI --}}
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-telephone"></i> Liên hệ & Mạng xã hội
                    </h3>
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">Thông tin liên hệ</h6>
                            <ul class="list-unstyled small">
                                <li><strong>Hotline:</strong> <a href="tel:1900888999" class="text-decoration-none">1900 888 999</a></li>
                                <li><strong>Email:</strong> <a href="mailto:support@sportstore.vn" class="text-decoration-none">support@sportstore.vn</a></li>
                                <li><strong>Zalo:</strong> <a href="https://www.facebook.com/" class="text-decoration-none">+84 123 456 789</a></li>
                                <li><strong>Facebook Chat:</strong> <a href="https://www.facebook.com/messenger" class="text-decoration-none">SportStore Vietnam</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">Theo dõi chúng tôi trên mạng xã hộ</h6>
                            <div class="mt-2">
                                <a href="https://www.facebook.com/" class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-facebook"></i> Facebook</a>
                                <a href="https://www.instagram.com/" class="btn btn-sm btn-outline-danger"><i class="bi bi-instagram"></i> Instagram</a>
                                <br>
                                <a href="https://x.com/home?lang=vi" class="btn btn-sm btn-outline-info mt-2 me-2"><i class="bi bi-twitter"></i> Twitter</a>
                                <a href="https://www.youtube.com/" class="btn btn-sm btn-outline-dark"><i class="bi bi-youtube"></i> YouTube</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 11. CÂU HỎI THƯỜNG GẶP --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title h4 text-uppercase border-bottom pb-2">
                        <i class="bi bi-question-circle"></i> Câu hỏi thường gặp (FAQ)
                    </h3>
                    <div class="accordion mt-3" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Làm sao tôi có thể biết sản phẩm là hàng chính hãng?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Tất cả sản phẩm của SportStore đều có giấy chứng nhận chính hãng, phiếu bảo hành từ nhà sản xuất. Nếu phát hiện hàng giả, chúng tôi hoàn tiền 200% và không cần lý do.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Thời gian giao hàng mất bao lâu?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    - Nội thành TP.HCM & Hà Nội: 2 giờ (giao hàng hỏa tốc)<br>
                                    - Các tỉnh khác: 3-5 ngày làm việc<br>
                                    - Bạn có thể theo dõi đơn hàng real-time qua website.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Tôi có thể đổi trả hàng được không nếu sản phẩm không vừa size?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Có, bạn có thể đổi hoặc trả hàng trong vòng 30 ngày nếu sản phẩm chưa sử dụng hoặc có lỗi. Chúng tôi sẽ hoàn tiền 100% nếu đơn hàng chưa qua sử dụng.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Có chương trình khuyến mãi nào cho khách hàng mới không?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    Có! Khách hàng mới được giảm 10% khi mua hàng lần đầu tiên. Ngoài ra, bạn cũng có thể tham gia chương trình tích điểm và nhập mã khuyến mãi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
