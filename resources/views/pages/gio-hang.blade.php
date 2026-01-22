@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="fa fa-shopping-cart me-2"></i>Giỏ hàng
            </h3>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>

        {{-- Cột trái: Danh sách sản phẩm trong giỏ --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    @if ($items->count() == 0)
                        <div class="alert alert-info mb-0">
                            Giỏ hàng đang trống. <a href="{{ route('shop.index') }}">Tiếp tục mua sắm</a>
                        </div>
                    @else

                        <form method="POST" action="{{ route('cart.update') }}" id="formCapNhatGio">
                            @csrf

                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th class="text-center" style="width: 160px;">Số lượng</th>
                                            <th class="text-end" style="width: 140px;">Đơn giá</th>
                                            <th class="text-end" style="width: 140px;">Thành tiền</th>
                                            <th class="text-end" style="width: 90px;">Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $it)
                                            @php
                                                $anh = $it->anhDauTien ? asset('img/' . $it->anhDauTien) : asset('img/no-image.png');
                                                $donGia = (float)($it->GiaGoc ?? 0);
                                                $sl = (int)($it->SoLuong ?? 1);
                                                $thanhTien = $donGia * $sl;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $anh }}" class="rounded border me-3" style="width:70px;height:70px;object-fit:cover" alt="sp" />
                                                        <div>
                                                            <div class="fw-semibold">{{ $it->TenSP }}</div>
                                                            <div class="text-muted small">
                                                                Size: <strong>{{ $it->TenKT ?? '-' }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <input
                                                        type="number"
                                                        min="1"
                                                        class="form-control text-center"
                                                        style="max-width: 120px; margin: 0 auto;"
                                                        name="soLuong[{{ $it->MaBT }}]"
                                                        value="{{ $sl }}"
                                                    />
                                                </td>

                                                <td class="text-end">{{ number_format($donGia, 0, ',', '.') }} đ</td>
                                                <td class="text-end fw-semibold">{{ number_format($thanhTien, 0, ',', '.') }} đ</td>

                                                <td class="text-end">
                                                    <button
                                                        type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="xoaItem({{ (int)$it->MaBT }})"
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex flex-wrap justify-content-between mt-4 gap-2">
                                <a href="{{ route('shop.index') }}" class="btn btn-outline-primary">
                                    <i class="fa fa-arrow-left me-2"></i>Tiếp tục mua hàng
                                </a>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fa fa-sync me-2"></i>Cập nhật giỏ
                                    </button>
                                    <button class="btn btn-outline-danger" type="button" onclick="xoaHet()">
                                        <i class="fa fa-trash me-2"></i>Xóa hết
                                    </button>
                                </div>
                            </div>
                        </form>

                        {{-- Form ẩn xóa 1 item --}}
                        <form id="formXoaItem" method="POST" action="{{ route('cart.remove') }}" style="display:none;">
                            @csrf
                            <input type="hidden" name="MaBT" id="maBTXoa" value="">
                        </form>

                        {{-- Form ẩn xóa hết --}}
                        <form id="formXoaHet" method="POST" action="{{ route('cart.clear') }}" style="display:none;">
                            @csrf
                        </form>

                        {{-- (27) Phân trang --}}
                        <div class="d-flex justify-content-center mt-4">
                            {{ $items->links() }}
                        </div>

                    @endif
                </div>
            </div>
        </div>

        {{-- Cột phải: Tổng kết --}}
        <div class="col-lg-4">
            <h3 class="mb-4">Tổng thanh toán</h3>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính</span>
                        <span class="fw-semibold">{{ number_format((float)$tamTinh, 0, ',', '.') }} đ</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển</span>
                        <span class="fw-semibold">{{ number_format((float)$phiShip, 0, ',', '.') }} đ</span>
                    </div>

                    <hr />

                    <div class="d-flex justify-content-between mb-3">
                        <span class="fs-5 fw-bold">Tổng cộng</span>
                        <span class="fs-5 fw-bold text-primary">{{ number_format((float)$tong, 0, ',', '.') }} đ</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn btn-primary w-100 py-2">
                        <i class="fa fa-credit-card me-2"></i>Tiến hành thanh toán
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function xoaItem(maBT) {
    if (!confirm('Xóa sản phẩm này khỏi giỏ?')) return;
    document.getElementById('maBTXoa').value = maBT;
    document.getElementById('formXoaItem').submit();
}

function xoaHet() {
    if (!confirm('Bạn chắc chắn muốn xóa hết giỏ hàng?')) return;
    document.getElementById('formXoaHet').submit();
}
</script>
@endpush
