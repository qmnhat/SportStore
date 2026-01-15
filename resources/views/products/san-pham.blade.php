@extends('layouts.app')
@section('title', 'Sản phẩm')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">San pham</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">San pham</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    @php
        // giu query hien tai de click loc khong mat q
        $q = request()->query();
    @endphp

    <!-- Shop Page Start -->
    <div class="container-fluid shop py-5">
        <div class="container py-5">
            <div class="row g-4">
                {{-- LEFT: sidebar --}}
                <div class="col-lg-3 wow fadeInUp" data-wow-delay="0.1s">

                    {{-- DANH MUC --}}
                    <div class="product-categories mb-4">
                        <h4>Danh muc</h4>
                        <ul class="list-unstyled">

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ empty($maDM) ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['dm' => null])) }}">
                                        Tat ca
                                    </a>
                                    <span class="text-muted">(All)</span>
                                </div>
                            </li>

                            @forelse ($danhMucs as $dmItem)
                                <li>
                                    <div class="categories-item d-flex justify-content-between">
                                        <a class="text-dark {{ (string) $maDM === (string) $dmItem->MaDM ? 'fw-bold' : '' }}"
                                            href="{{ route('shop.index', array_merge($q, ['dm' => $dmItem->MaDM])) }}">
                                            {{ $dmItem->TenDM }}
                                        </a>
                                        <span>({{ $dmItem->soLuong }})</span>
                                    </div>
                                </li>
                            @empty
                                <li class="text-muted">Chua co danh muc</li>
                            @endforelse

                        </ul>
                    </div>

                    {{-- GIA --}}
                    <div class="product-categories mb-4">
                        <h4>Gia</h4>
                        <ul class="list-unstyled">

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ empty($gia) ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => null])) }}">
                                        Tat ca
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ $gia == '1' ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => 1])) }}">
                                        &lt; 1 trieu
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ $gia == '2' ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => 2])) }}">
                                        &lt; 2 trieu
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ $gia == '3' ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => 3])) }}">
                                        &gt;= 2 trieu
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>

                    {{-- THUONG HIEU --}}
                    <div class="product-categories mb-4">
                        <h4>Thuong hieu</h4>
                        <ul class="list-unstyled">

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ empty($maTH) ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['th' => null])) }}">
                                        Tat ca
                                    </a>
                                    <span class="text-muted">(All)</span>
                                </div>
                            </li>

                            @forelse ($thuongHieus as $thItem)
                                <li>
                                    <div class="categories-item d-flex justify-content-between">
                                        <a class="text-dark {{ (string) $maTH === (string) $thItem->MaTH ? 'fw-bold' : '' }}"
                                            href="{{ route('shop.index', array_merge($q, ['th' => $thItem->MaTH])) }}">
                                            {{ $thItem->TenTH }}
                                        </a>
                                        <span>({{ $thItem->soLuong }})</span>
                                    </div>
                                </li>
                            @empty
                                <li class="text-muted">Chua co thuong hieu</li>
                            @endforelse

                        </ul>
                    </div>

                    {{-- XOA LOC --}}
                    <div class="d-grid mb-4">
                        <a class="btn btn-outline-secondary rounded-pill"
                            href="{{ route('shop.index', ['q' => $tuKhoa]) }}">
                            Xoa loc
                        </a>
                    </div>

                </div>

                {{-- RIGHT: products --}}
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">

                    {{-- top banner (mau) --}}
                    <div class="rounded mb-4 position-relative">
                        <img src="{{ asset('img/product-banner-3.jpg') }}" class="img-fluid rounded w-100"
                            style="height: 250px;" alt="Image">
                        <div class="position-absolute rounded d-flex flex-column align-items-center justify-content-center text-center"
                            style="width: 100%; height: 250px; top: 0; left: 0; background: rgba(242, 139, 0, 0.3);">
                            <h4 class="display-5 text-primary">SALE</h4>
                            <h3 class="display-4 text-white mb-4">Get UP To 50% Off</h3>
                            <a href="#" class="btn btn-primary rounded-pill">Shop Now</a>
                        </div>
                    </div>

                    {{-- SEARCH + VIEW MODE --}}
                    <div class="row g-4">
                        <div class="col-xl-7">
                            <form class="input-group w-100 mx-auto d-flex" method="GET"
                                action="{{ route('shop.index') }}">
                                {{-- giu filter khi search --}}
                                <input type="hidden" name="dm" value="{{ $maDM }}">
                                <input type="hidden" name="th" value="{{ $maTH }}">
                                <input type="hidden" name="gia" value="{{ $gia }}">

                                <input type="search" class="form-control p-3" name="q" value="{{ $tuKhoa ?? '' }}"
                                    placeholder="keywords" aria-describedby="search-icon-1">
                                <button type="submit" id="search-icon-1" class="input-group-text p-3">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>

                        <div class="col-xl-3 text-end">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between">
                                <label>Sort By:</label>
                                <select class="border-0 form-select-sm bg-light me-3" disabled>
                                    <option>Default Sorting</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xl-2">
                            <ul class="nav nav-pills d-inline-flex text-center py-2 px-2 rounded bg-light mb-4">
                                <li class="nav-item me-4">
                                    <a class="bg-light" data-bs-toggle="pill" href="#tab-5">
                                        <i class="fas fa-th fa-3x text-primary"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="bg-light" data-bs-toggle="pill" href="#tab-6">
                                        <i class="fas fa-bars fa-3x text-primary"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content">

                        {{-- GRID --}}
                        <div id="tab-5" class="tab-pane fade show p-0 active">
                            <div class="row g-4 product">

                                @forelse ($sanPhams as $sp)
                                    @php
                                        $anh = $sp->anhDauTien
                                            ? asset('img/' . $sp->anhDauTien)
                                            : asset('img/no-image.png');

                                        $giaSp = $sp->giaMin ?? 0;
                                    @endphp

                                    <div class="col-lg-4">
                                        <div class="product-item rounded wow fadeInUp" data-wow-delay="0.1s">
                                            <div class="product-item-inner border rounded">
                                                <div class="product-item-inner-item">
                                                    <img src="{{ $anh }}" class="img-fluid w-100 rounded-top"
                                                        alt="">
                                                    <div class="product-new">New</div>
                                                    <div class="product-details">
                                                        <a href="{{ route('shop.show', $sp->MaSP) }}"><i
                                                                class="fa fa-eye fa-1x"></i></a>
                                                    </div>
                                                </div>

                                                <div class="text-center rounded-bottom p-4">
                                                    <a href="#"
                                                        class="d-block mb-2">{{ $sp->tenDanhMuc ?? 'Danh muc' }}</a>
                                                    <a href="#" class="d-block h4">{{ $sp->TenSP }}</a>

                                                    <span class="text-primary fs-5">
                                                        {{ number_format($giaSp, 0, ',', '.') }} đ
                                                    </span>

                                                    <div class="text-muted small mt-1">
                                                        {{ $sp->tenThuongHieu ?? '' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="product-item-add border border-top-0 rounded-bottom text-center p-4 pt-0">
                                                <a href="#"
                                                    class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-4">
                                                    <i class="fas fa-shopping-cart me-2"></i> Add To Cart
                                                </a>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex">
                                                        <i class="fas fa-star text-primary"></i>
                                                        <i class="fas fa-star text-primary"></i>
                                                        <i class="fas fa-star text-primary"></i>
                                                        <i class="fas fa-star text-primary"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="d-flex">
                                                        <a href="#"
                                                            class="text-primary d-flex align-items-center justify-content-center me-3">
                                                            <span class="rounded-circle btn-sm-square border">
                                                                <i class="fas fa-random"></i>
                                                            </span>
                                                        </a>
                                                        <a href="#"
                                                            class="text-primary d-flex align-items-center justify-content-center">
                                                            <span class="rounded-circle btn-sm-square border">
                                                                <i class="fas fa-heart"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-warning mb-0">
                                            Khong co san pham nao.
                                        </div>
                                    </div>
                                @endforelse

                                {{-- pagination --}}
                                <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="d-flex justify-content-center mt-5">
                                        {{ $sanPhams->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- LIST tab-6: placeholder --}}
                        <div id="tab-6" class="tab-pane fade show p-0">
                            <div class="alert alert-info">
                                Tab list chua lam, tam thoi dung grid la du.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Page End -->
@endsection
