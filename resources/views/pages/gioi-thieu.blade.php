
@extends('layouts.app')

@section('title', 'Thông tin công ty - SportStore')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-10 mx-auto">

            {{-- 1. GIỚI THIỆU CHUNG --}}
            <div class="mb-5 text-center">
                <h1 class="display-4 fw-bold text-primary">Giới thiệu về SportStore</h1>
                <p class="lead text-muted">{{ $company->description }}</p>
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

                    @php
                        $policies = \App\Models\CompanyPolicy::get();
                    @endphp

                    @foreach($policies as $policy)
                    <div class="mt-4">
                        <h5 class="fw-bold text-dark">
                            @if($policy->type == 'shipping')
                                <i class="bi bi-truck"></i>
                            @elseif($policy->type == 'payment')
                                <i class="bi bi-cash-coin"></i>
                            @elseif($policy->type == 'return')
                                <i class="bi bi-arrow-repeat"></i>
                            @elseif($policy->type == 'security')
                                <i class="bi bi-shield-lock"></i>
                            @endif
                            {{ $policy->title }}
                        </h5>
                        <div class="mt-2">
                            {!! $policy->content !!}
                        </div>
                    </div>
                    @endforeach

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
                                <li><strong>Hotline:</strong> <a href="tel:{{ str_replace(' ', '', $company->hotline) }}" class="text-decoration-none">{{ $company->hotline }}</a></li>
                                <li><strong>Email:</strong> <a href="mailto:{{ $company->email }}" class="text-decoration-none">{{ $company->email }}</a></li>
                                @if($company->zalo_phone)
                                <li><strong>Zalo:</strong> <a href="tel:{{ str_replace(' ', '', $company->zalo_phone) }}" class="text-decoration-none">{{ $company->zalo_phone }}</a></li>
                                @endif
                                <li><strong>Facebook Chat:</strong> <a href="{{ $company->facebook_url }}" class="text-decoration-none">SportStore Vietnam</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-bold">Theo dõi chúng tôi trên mạng xã hộ</h6>
                            <div class="mt-2">
                                @if($company->facebook_url)
                                <a href="{{ $company->facebook_url }}" class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-facebook"></i> Facebook</a>
                                @endif
                                @if($company->instagram_url)
                                <a href="{{ $company->instagram_url }}" class="btn btn-sm btn-outline-danger"><i class="bi bi-instagram"></i> Instagram</a>
                                @endif
                                <br>
                                @if($company->twitter_url)
                                <a href="{{ $company->twitter_url }}" class="btn btn-sm btn-outline-info mt-2 me-2"><i class="bi bi-twitter"></i> Twitter</a>
                                @endif
                                @if($company->youtube_url)
                                <a href="{{ $company->youtube_url }}" class="btn btn-sm btn-outline-dark"><i class="bi bi-youtube"></i> YouTube</a>
                                @endif
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

                    @php
                        $faqs = \App\Models\CompanyFaq::get();
                    @endphp

                    <div class="accordion mt-3" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="faq{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body small text-muted">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
