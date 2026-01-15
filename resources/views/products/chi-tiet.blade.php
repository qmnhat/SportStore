@extends('layouts.app')

@section('title', $sanPham->TenSP ?? 'Chi tiet san pham')

@push('styles')
    <style>
        .single-thumb img {
            width: 70px;
            height: 70px;
            object-fit: cover;
        }

        .single-main-img {
            width: 100%;
            height: 430px;
            object-fit: contain;
        }

        .badge-star {
            font-size: 12px;
        }

        .size-btn.active {
            background: #0d6efd;
            color: #fff;
            border-color: #0d6efd;
        }
    </style>
@endpush

@section('content')
    @php
        // an toan null
        $hinhAnhs = is_array($hinhAnhs ?? null) ? $hinhAnhs : [];
        $anhChinh = count($hinhAnhs) > 0 ? asset('img/' . $hinhAnhs[0]) : asset('img/no-image.png');

        $giaMin = (float) ($sanPham->giaMin ?? 0);
        $giaMax = (float) ($sanPham->giaMax ?? 0);

        $saoTb = (float) ($sanPham->saoTrungBinh ?? 0);
        $soDanhGia = (int) ($sanPham->soLuotDanhGia ?? 0);
    @endphp

    <!-- Page Header -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Chi tiet san pham</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Shop</a></li>
            <li class="breadcrumb-item active text-white">{{ $sanPham->TenSP }}</li>
        </ol>
    </div>

    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">

                {{-- LEFT SIDEBAR (giu style mau) --}}
                <div class="col-lg-5 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">

                    <div class="mb-4">
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary rounded-pill w-100">
                            <i class="fa fa-arrow-left me-1"></i> Quay lai shop
                        </a>
                    </div>

                    {{-- Thong tin nhanh --}}
                    <div class="bg-light rounded p-4 mb-4">
                        <h5 class="mb-3">Thong tin</h5>
                        <div class="small text-muted mb-1">Danh muc</div>
                        <div class="fw-bold mb-3">{{ $sanPham->tenDanhMuc ?? '-' }}</div>

                        <div class="small text-muted mb-1">Thuong hieu</div>
                        <div class="fw-bold mb-3">{{ $sanPham->tenThuongHieu ?? '-' }}</div>

                        <div class="small text-muted mb-1">Danh gia</div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-warning text-dark badge-star">
                                {{ number_format($saoTb, 1) }}/5
                            </span>
                            <span class="text-muted">({{ $soDanhGia }} luot)</span>
                        </div>
                    </div>

                    {{-- Sizes (bien the) --}}
                    <div class="bg-light rounded p-4 mb-4">
                        <h5 class="mb-3">Kich thuoc</h5>

                        @if (($bienThes->count() ?? 0) == 0)
                            <div class="text-muted">Chua co bien the.</div>
                        @else
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($bienThes as $bt)
                                    <button type="button" class="btn btn-outline-dark btn-sm size-btn"
                                        data-bt="{{ $bt->MaBT }}" data-gia="{{ (float) $bt->GiaGoc }}"
                                        data-ton="{{ (int) $bt->SoLuong }}">
                                        {{ $bt->TenKT }}
                                    </button>
                                @endforeach
                            </div>

                            <div class="small text-muted mt-3">
                                * Bam size de xem gia / ton (demo UI)
                            </div>
                        @endif
                    </div>

                    {{-- Banner mau --}}
                    <a href="#">
                        <div class="position-relative">
                            <img src="{{ asset('img/product-banner-2.jpg') }}" class="img-fluid w-100 rounded"
                                alt="Image">
                            <div class="text-center position-absolute d-flex flex-column align-items-center justify-content-center rounded p-4"
                                style="width: 100%; height: 100%; top: 0; right: 0; background: rgba(242, 139, 0, 0.3);">
                                <h5 class="display-6 text-primary">SALE</h5>
                                <h4 class="text-secondary">Get UP To 50% Off</h4>
                                <span class="btn btn-primary rounded-pill px-4">Shop Now</span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- RIGHT MAIN --}}
                <div class="col-lg-7 col-xl-9 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4 single-product">

                        {{-- Carousel Images --}}
                        <div class="col-xl-6">
                            <div class="bg-light rounded p-3">
                                <img id="mainImg" src="{{ $anhChinh }}" class="img-fluid rounded single-main-img"
                                    alt="">
                            </div>

                            @if (count($hinhAnhs) > 1)
                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    @foreach ($hinhAnhs as $a)
                                        @php $src = asset('img/' . $a); @endphp
                                        <a href="javascript:void(0)" class="single-thumb border rounded p-1 bg-white"
                                            onclick="document.getElementById('mainImg').src='{{ $src }}'">
                                            <img src="{{ $src }}" class="img-fluid rounded" alt="">
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="col-xl-6">
                            <h4 class="fw-bold mb-2">{{ $sanPham->TenSP }}</h4>
                            <p class="mb-2">Category: <span class="fw-bold">{{ $sanPham->tenDanhMuc ?? '-' }}</span></p>

                            <h5 class="fw-bold mb-3">
                                <span id="giaHienThi" class="text-primary">
                                    {{ number_format($giaMin, 0, ',', '.') }} d
                                </span>
                                @if ($giaMax > $giaMin)
                                    <small class="text-muted ms-2">
                                        - {{ number_format($giaMax, 0, ',', '.') }} d
                                    </small>
                                @endif
                            </h5>

                            <div class="d-flex align-items-center mb-3">
                                @php
                                    $full = floor($saoTb);
                                    $half = $saoTb - $full >= 0.5;
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $full)
                                        <i class="fa fa-star text-secondary"></i>
                                    @elseif ($half && $i == $full + 1)
                                        <i class="fa fa-star-half-alt text-secondary"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                @endfor
                                <span class="text-muted ms-2">({{ $soDanhGia }})</span>
                            </div>

                            <div class="d-flex flex-column mb-3">
                                <small>Product SKU: SP{{ $sanPham->MaSP }}</small>
                                <small>Available: <strong id="tonKho" class="text-primary">--</strong></small>
                            </div>

                            <p class="mb-4" style="white-space:pre-line">
                                {{ $sanPham->MoTa ?? 'Chua co mo ta' }}
                            </p>

                            {{-- Quantity UI --}}
                            <div class="input-group quantity mb-4" style="width: 130px;">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" type="button"
                                    onclick="qtyDown()">
                                    <i class="fa fa-minus"></i>
                                </button>

                                <input id="qtyInput" type="text"
                                    class="form-control form-control-sm text-center border-0" value="1">

                                <button class="btn btn-sm btn-plus rounded-circle bg-light border" type="button"
                                    onclick="qtyUp()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>

                            {{-- Add to cart (placeholder) --}}
                            <button class="btn btn-primary border border-secondary rounded-pill px-4 py-2 mb-4"
                                type="button" onclick="alert('Chua lam cart')">
                                <i class="fa fa-shopping-bag me-2 text-white"></i> Add to cart
                            </button>
                        </div>

                        {{-- Tabs: Description / Reviews --}}
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button"
                                        data-bs-toggle="tab" data-bs-target="#tab-desc">
                                        Description
                                    </button>
                                    <button class="nav-link border-white border-bottom-0" type="button"
                                        data-bs-toggle="tab" data-bs-target="#tab-rev">
                                        Reviews ({{ $soDanhGia }})
                                    </button>
                                </div>
                            </nav>

                            <div class="tab-content mb-5">
                                {{-- Description --}}
                                <div class="tab-pane fade show active" id="tab-desc">
                                    <div class="bg-light rounded p-4">
                                        <div style="white-space:pre-line">
                                            {{ $sanPham->MoTa ?? 'Chua co mo ta' }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Reviews --}}
                                <div class="tab-pane fade" id="tab-rev">
                                    <div class="bg-light rounded p-4">

                                        @if (($danhGias->count() ?? 0) == 0)
                                            <div class="text-muted">Chua co danh gia nao.</div>
                                        @else
                                            @foreach ($danhGias as $dg)
                                                <div class="d-flex border-bottom pb-3 mb-3">
                                                    <img src="{{ asset('img/avatar.jpg') }}"
                                                        class="img-fluid rounded-circle p-2"
                                                        style="width: 80px; height: 80px; object-fit:cover"
                                                        alt="">
                                                    <div class="ms-3 w-100">
                                                        <div class="d-flex justify-content-between">
                                                            <h6 class="mb-0">{{ $dg->HoTen }}</h6>
                                                            <small class="text-muted">
                                                                {{ \Carbon\Carbon::parse($dg->NgayDanhGia)->format('d/m/Y H:i') }}
                                                            </small>
                                                        </div>

                                                        <div class="d-flex align-items-center mb-2">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fa fa-star {{ $i <= (int) $dg->SoSao ? 'text-secondary' : '' }}"></i>
                                                            @endfor
                                                            <span class="badge bg-warning text-dark ms-2 badge-star">
                                                                {{ (int) $dg->SoSao }} sao
                                                            </span>
                                                        </div>

                                                        <div class="text-dark" style="white-space:pre-line">
                                                            {{ $dg->NoiDung ?? 'Khong co noi dung' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="d-flex justify-content-center">
                                                {{ $danhGias->links() }}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Related products (placeholder: sau m lam truy van lay sp lien quan) --}}
                        <div class="col-12">
                            <div class="mx-auto text-center pb-4" style="max-width: 700px;">
                                <h4
                                    class="text-primary mb-3 border-bottom border-primary border-2 d-inline-block p-2 title-border-radius">
                                    Related Products
                                </h4>
                                <p class="text-muted mb-0">Tam thoi de placeholder. Can thi tao viet query related theo
                                    DanhMuc.</p>
                            </div>

                            <div class="alert alert-info mb-0">
                                Related Products chua noi DB. Muon tao query thi noi tao.
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function qtyUp() {
            const el = document.getElementById('qtyInput');
            let v = parseInt(el.value || '1');
            el.value = (v + 1);
        }

        function qtyDown() {
            const el = document.getElementById('qtyInput');
            let v = parseInt(el.value || '1');
            el.value = Math.max(1, v - 1);
        }

        // Click size -> doi gia + ton kho (UI)
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const gia = parseFloat(btn.getAttribute('data-gia') || '0');
                const ton = parseInt(btn.getAttribute('data-ton') || '0');

                document.getElementById('giaHienThi').innerText = gia.toLocaleString('vi-VN') + ' d';
                document.getElementById('tonKho').innerText = ton + ' items';
            });
        });
    </script>
@endsection
