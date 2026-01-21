@extends('layouts.app')

@section('title', 'Sản phẩm')

@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6 wow fadeInUp" data-wow-delay="0.1s">Sản phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0 wow fadeInUp" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
            <li class="breadcrumb-item active text-white">Sản phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    @php
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
                        <h4>Danh mục</h4>
                        <ul class="list-unstyled">

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ empty($maDM) ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['dm' => null])) }}">
                                        Tất cả
                                    </a>
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
                                <li class="text-muted">Chưa có danh mục</li>
                            @endforelse

                        </ul>
                    </div>

                    {{-- GIA --}}
                    <div class="product-categories mb-4">
                        <h4>Giá</h4>
                        <ul class="list-unstyled">

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ empty($gia) ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => null])) }}">
                                        Tất cả
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ $gia == '1' ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => 1])) }}">
                                        &lt; 1 triệu
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ $gia == '2' ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => 2])) }}">
                                        &lt; 2 triệu
                                    </a>
                                </div>
                            </li>

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ $gia == '3' ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['gia' => 3])) }}">
                                        &gt;= 2 triệu
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>

                    {{-- THUONG HIEU --}}
                    <div class="product-categories mb-4">
                        <h4>Thương hiệu</h4>
                        <ul class="list-unstyled">

                            <li>
                                <div class="categories-item d-flex justify-content-between">
                                    <a class="text-dark {{ empty($maTH) ? 'fw-bold' : '' }}"
                                        href="{{ route('shop.index', array_merge($q, ['th' => null])) }}">
                                        Tất cả
                                    </a>
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
                                <li class="text-muted">Chưa có thương hiệu</li>
                            @endforelse

                        </ul>
                    </div>

                    {{-- XOA LOC --}}
                    <div class="d-grid mb-4">
                        <a class="btn btn-outline-secondary rounded-pill"
                            href="{{ route('shop.index', ['q' => $tuKhoa]) }}">
                            Xóa lọc
                        </a>
                    </div>
                </div>

                {{-- RIGHT: products --}}
                <div class="col-lg-9 wow fadeInUp" data-wow-delay="0.1s">

                    {{-- top banner --}}


                    {{-- SEARCH --}}
                    <div class="row g-4">
                        <div class="col-xl-7">
                            <form class="input-group w-100 mx-auto d-flex" method="GET"
                                action="{{ route('shop.index') }}">
                                <input type="hidden" name="dm" value="{{ $maDM }}">
                                <input type="hidden" name="th" value="{{ $maTH }}">
                                <input type="hidden" name="gia" value="{{ $gia }}">

                                <input type="search" class="form-control p-3" name="q" value="{{ $tuKhoa ?? '' }}"
                                    placeholder="Tìm kiếm sản phẩm..." aria-describedby="search-icon-1">
                                <button type="submit" id="search-icon-1" class="input-group-text p-3">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>



                    </div>

                    <div class="tab-content">
                        {{-- GRID --}}
                        <div id="tab-5" class="tab-pane fade show p-0 active">
                            <div class="row g-4 product">

                                @forelse ($sanPhams as $sp)
                                    @php
                                        $anh = $sp->anhDauTien
                                            ? asset($sp->anhDauTien)
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
                                                        <a href="{{ route('shop.show', $sp->slug) }}"><i
                                                                class="fa fa-eye fa-1x"></i></a>
                                                    </div>
                                                </div>

                                                <div class="text-center rounded-bottom p-4">
                                                    <a href="#"
                                                        class="d-block mb-2">{{ $sp->tenDanhMuc ?? 'Danh muc' }}</a>
                                                    <a href="{{ route('shop.show', $sp->slug) }}" class="d-block h4">{{ $sp->TenSP }}</a>

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
                                                <a href="{{ route('shop.show', $sp->slug) }}"
                                                    class="btn btn-primary border-secondary rounded-pill py-2 px-4 mb-3">
                                                    <i class="fas fa-eye me-2"></i> Xem chi tiết
                                                </a>

                                                @php
                                                    $saoTb = (float) ($sp->saoTrungBinh ?? 0);
                                                    $soLuot = (int) ($sp->soLuotDanhGia ?? 0);
                                                    $full = (int) floor($saoTb);
                                                    $half = $saoTb - $full >= 0.5;
                                                @endphp

                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="d-flex">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $full)
                                                                <i class="fas fa-star text-primary"></i>
                                                            @elseif ($half && $i == $full + 1)
                                                                <i class="fas fa-star-half-alt text-primary"></i>
                                                            @else
                                                                <i class="fas fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <small class="text-muted">({{ $soLuot }})</small>

                                                    <div class="d-flex">
                                                        <button type="button"
                                                            onclick="toggleYeuThich({{ $sp->MaSP }}, this)"
                                                            class="btn p-0 border-0 bg-transparent text-primary d-flex align-items-center justify-content-center">
                                                            <span class="rounded-circle btn-sm-square border">
                                                                <i class="fas fa-heart"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-warning mb-0">Khong co san pham nao.</div>
                                    </div>
                                @endforelse

                                {{-- pagination --}}
                                <div class="col-12">
                                    <div class="d-flex justify-content-center mt-4">
                                        <div class="pagination-wrap">
                                            {{ $sanPhams->links('pagination::bootstrap-5') }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Shop Page End -->
@endsection

@push('scripts')
    <script>
        function toggleYeuThich(maSP, el) {
            fetch("{{ route('yeuthich.toggle') }}", {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        MaSP: maSP
                    }),
                })
                .then(async (res) => {
                    if (res.status === 401) {
                        alert(
                            "Ban can dang nhap de dung chuc nang yeu thich.\nNeu ban da login roi: kiem tra dung 1 domain (localhost hoac 127.0.0.1) + route co dung middleware auth(web) khong."
                        );
                        return null;
                    }

                    const ct = res.headers.get("content-type") || "";
                    if (!ct.includes("application/json")) return null;

                    return res.json();
                })
                .then((data) => {
                    if (!data) return;

                    const icon = el.querySelector("i");
                    if (!icon) return;

                    if (data.status === "added") icon.classList.add("text-danger");
                    if (data.status === "removed") icon.classList.remove("text-danger");
                })
                .catch(() => alert("Co loi khi goi yeu thich"));
        }
    </script>
@endpush
