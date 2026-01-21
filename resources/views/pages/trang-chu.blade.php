@extends('layouts.app')
@section('title', 'Trang chủ')
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid carousel bg-light px-0">
        <div class="row g-0 justify-content-end">
            <div class="col-12 col-lg-6 col-xl-12">
                <div class="header-carousel owl-carousel bg-light py-5">
                    @foreach ($sliderSanPham as $sp)
                        <div class="row g-0 header-carousel-item align-items-center">

                            {{-- HÌNH ẢNH --}}
                            <div class="col-xl-6 carousel-img wow fadeInLeft" data-wow-delay="0.1s">
                                <img src="{{ asset($sp->hinhAnh->first()->DuongDan ?? 'img/default.png') }}"
                                    class="img-fluid w-100" alt="{{ $sp->TenSP }}">
                            </div>

                            {{-- NỘI DUNG --}}
                            <div class="col-xl-6 carousel-content p-4">

                                @php
                                    $giaGoc = $sp->bienThe->first()->GiaGoc ?? 0;
                                    $phanTram = $sp->khuyenMai->first()->PhanTramGiam ?? 0;
                                @endphp

                                <h4 class="text-uppercase fw-bold mb-4 text-danger">
                                    Giảm {{ $phanTram }}%
                                </h4>

                                <h1 class="display-5 text-capitalize mb-4">
                                    {{ $sp->TenSP }}
                                </h1>

                                <p class="text-dark">
                                    Giá chỉ còn
                                    <strong>{{ number_format($giaGoc - ($giaGoc * $phanTram) / 100) }} đ</strong>
                                </p>

                                {{-- LINK ĐÚNG SẢN PHẨM --}}
                                <a class="btn btn-primary rounded-pill py-3 px-5"
                                    href="{{ route('shop.show', $sp->slug) }}">
                                    Mua ngay
                                </a>


                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- Carousel End -->

    <!-- Searvices Start -->
    <div class="container-fluid px-0">
        <div class="row g-0">
            <div class="col-6 col-md-4 col-lg-2 border-start border-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="p-4">
                    <div class="d-inline-flex align-items-center">
                        <i class="fa fa-sync-alt fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Đổi trả miễn phí</h6>
                            <p class="mb-0">Hoàn tiền trong 30 ngày</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.2s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram-plane fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Miễn phí vận chuyển</h6>
                            <p class="mb-0">Cho mọi đơn hàng</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.3s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-life-ring fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Hỗ trợ 24/7</h6>
                            <p class="mb-0">Hỗ trợ trực tuyến 24h</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.4s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-credit-card fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Nhận quà tặng</h6>
                            <p class="mb-0">Đơn hàng trên 500.000đ</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.5s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-lock fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Thanh toán an toàn</h6>
                            <p class="mb-0">Bảo mật thông tin</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2 border-end wow fadeInUp" data-wow-delay="0.6s">
                <div class="p-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-blog fa-2x text-primary"></i>
                        <div class="ms-4">
                            <h6 class="text-uppercase mb-2">Dịch vụ trực tuyến</h6>
                            <p class="mb-0">Đặt hàng dễ dàng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Searvices End -->



    <!-- Our Products Start -->
    <div class="container-fluid product py-5">
        <div class="container py-5">
            <div class="tab-class">
                <div class="row g-4">
                    <div class="col-lg-4 text-start wow fadeInLeft" data-wow-delay="0.1s">
                        <h1>Sản phẩm</h1>
                    </div>
                    <div class="col-lg-8 text-end wow fadeInRight" data-wow-delay="0.1s">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5">
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                    href="#tab-1">
                                    <span class="text-dark" style="width: 130px;">Tất cả</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex py-2 mx-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 130px;">Mới về</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 130px;">Nổi bật</span>
                                </a>
                            </li>
                            <li class="nav-item mb-4">
                                <a class="d-flex mx-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                    <span class="text-dark" style="width: 130px;">Bán chạy</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            @foreach ($allProducts as $sp)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item">

                                        {{-- HÌNH ẢNH SẢN PHẨM --}}
                                        <img src="{{ asset($sp->hinhAnh->first()->DuongDan ?? 'img/default.png') }}"
                                            class="img-fluid w-100" alt="{{ $sp->TenSP }}">

                                        {{-- TÊN SẢN PHẨM --}}
                                        <h6 class="mt-2">{{ $sp->TenSP }}</h6>
                                        @php
                                            $giaGoc = $sp->bienThe->first()->GiaGoc ?? 0;
                                            $phanTram = $sp->khuyenMai->first()->PhanTramGiam ?? 0;
                                            $giaSauGiam = $giaGoc - ($giaGoc * $phanTram) / 100;
                                        @endphp


                                        {{-- GIÁ --}}
                                        @if ($phanTram > 0)
                                            <p class="text-muted text-decoration-line-through">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaSauGiam) }} đ
                                                <span class="badge bg-danger ms-1">
                                                    -{{ $phanTram }}%
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                        @endif

                                        {{-- LINK CHI TIẾT --}}
                                        <a href="{{ route('shop.show', $sp->slug) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Chi tiết
                                        </a>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach ($newArrivals as $sp)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item">

                                        <img src="{{ asset($sp->hinhAnh->first()->DuongDan ?? 'img/default.png') }}"
                                            class="img-fluid w-100" alt="{{ $sp->TenSP }}">

                                        <h6 class="mt-2">{{ $sp->TenSP }}</h6>

                                        @php
                                            $giaGoc = $sp->bienThe->first()->GiaGoc ?? 0;
                                            $phanTram = $sp->khuyenMai->first()->PhanTramGiam ?? 0;
                                            $giaSauGiam = $giaGoc - ($giaGoc * $phanTram) / 100;
                                        @endphp


                                        {{-- GIÁ --}}
                                        @if ($phanTram > 0)
                                            <p class="text-muted text-decoration-line-through">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaSauGiam) }} đ
                                                <span class="badge bg-danger ms-1">
                                                    -{{ $phanTram }}%
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                        @endif

                                        <a href="{{ route('shop.show', $sp->slug) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Chi tiết
                                        </a>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach ($featured as $sp)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item">

                                        <img src="{{ asset($sp->hinhAnh->first()->DuongDan ?? 'img/default.png') }}"
                                            class="img-fluid w-100" alt="{{ $sp->TenSP }}">

                                        <h6 class="mt-2">{{ $sp->TenSP }}</h6>

                                        @php
                                            $giaGoc = $sp->bienThe->first()->GiaGoc ?? 0;
                                            $phanTram = $sp->khuyenMai->first()->PhanTramGiam ?? 0;
                                            $giaSauGiam = $giaGoc - ($giaGoc * $phanTram) / 100;
                                        @endphp


                                        {{-- GIÁ --}}
                                        @if ($phanTram > 0)
                                            <p class="text-muted text-decoration-line-through">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaSauGiam) }} đ
                                                <span class="badge bg-danger ms-1">
                                                    -{{ $phanTram }}%
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                        @endif

                                        <a href="{{ route('shop.show', $sp->MaSP) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Chi tiết
                                        </a>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            @foreach ($topSelling as $sp)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="product-item">

                                        <img src="{{ asset($sp->hinhAnh->first()->DuongDan ?? 'img/default.png') }}"
                                            class="img-fluid w-100" alt="{{ $sp->TenSP }}">

                                        <h6 class="mt-2">{{ $sp->TenSP }}</h6>

                                        @php
                                            $giaGoc = $sp->bienThe->first()->GiaGoc ?? 0;
                                            $phanTram = $sp->khuyenMai->first()->PhanTramGiam ?? 0;
                                            $giaSauGiam = $giaGoc - ($giaGoc * $phanTram) / 100;
                                        @endphp


                                        {{-- GIÁ --}}
                                        @if ($phanTram > 0)
                                            <p class="text-muted text-decoration-line-through">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaSauGiam) }} đ
                                                <span class="badge bg-danger ms-1">
                                                    -{{ $phanTram }}%
                                                </span>
                                            </p>
                                        @else
                                            <p class="text-danger fw-bold">
                                                {{ number_format($giaGoc) }} đ
                                            </p>
                                        @endif

                                        <a href="{{ route('shop.show', $sp->MaSP) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Chi tiết
                                        </a>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Products End -->

    <!-- Product Banner Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-4">
                @if ($bannerNoiBat)
                    <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                        <a href="{{ route('shop.show', $bannerNoiBat->slug) }}">
                            <div class="bg-primary rounded position-relative">

                                <img src="{{ asset($bannerNoiBat->hinhAnh->first()->DuongDan ?? 'img/default.png') }}"
                                    class="img-fluid w-100 rounded" alt="{{ $bannerNoiBat->TenSP }}">

                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                    style="background: rgba(255, 255, 255, 0.5);">

                                    <h3 class="display-5 text-primary">
                                        {{ $bannerNoiBat->TenSP }}
                                    </h3>

                                    <p class="fs-4 text-muted">
                                        {{ number_format($bannerNoiBat->bienThe->first()->GiaGoc ?? 0) }} đ
                                    </p>

                                    <span class="btn btn-primary rounded-pill align-self-start py-2 px-4">
                                        Mua ngay
                                    </span>

                                </div>
                            </div>
                        </a>
                    </div>
                @endif

                @if ($bannerKhuyenMai)
                    @php
                        $giaGoc = $bannerKhuyenMai->bienThe->first()->GiaGoc ?? 0;
                        $phanTram = $bannerKhuyenMai->khuyenMai->first()->PhanTramGiam ?? 0;
                        $giaSauGiam = $giaGoc - ($giaGoc * $phanTram) / 100;
                    @endphp

                    <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                        <a href="{{ route('shop.show', $bannerKhuyenMai->slug) }}">
                            <div class="text-center bg-primary rounded position-relative">

                                <img src="{{ asset($bannerKhuyenMai->hinhAnh->first()->DuongDan ?? 'img/default.png') }}"
                                    class="img-fluid w-100" alt="{{ $bannerKhuyenMai->TenSP }}">

                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center rounded p-4"
                                    style="background: rgba(242, 139, 0, 0.5);">

                                    <h2 class="display-2 text-secondary">
                                        SALE {{ $phanTram }}%
                                    </h2>

                                    <h4 class="display-5 text-white mb-4">
                                        {{ number_format($giaSauGiam) }} đ
                                    </h4>

                                    <span class="btn btn-secondary rounded-pill py-2 px-4">
                                        Mua ngay
                                    </span>

                                </div>
                            </div>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- Product Banner End -->
@endsection

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
