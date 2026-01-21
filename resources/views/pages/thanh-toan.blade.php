@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">
        <i class="fa fa-credit-card me-2"></i>Thanh toán
    </h3>

    <form id="formDatHang" method="POST" action="{{ route('checkout.process') }}">
        @csrf

        {{-- Thông tin người nhận --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Thông tin giao hàng</div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Họ tên</label>
                    <input type="text" name="ho_ten" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Số điện thoại</label>
                    <input type="text" name="dien_thoai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Địa chỉ</label>
                    <textarea name="dia_chi" class="form-control" required></textarea>
                </div>
            </div>
        </div>

        {{-- Phương thức thanh toán --}}
        <div class="card mb-4">
            <div class="card-header fw-bold">Phương thức thanh toán</div>
            <div class="card-body">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="phuong_thuc" value="cod" checked>
                    <label class="form-check-label">
                        Thanh toán khi nhận hàng (COD)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="phuong_thuc" value="bank">
                    <label class="form-check-label">
                        Chuyển khoản ngân hàng
                    </label>
                </div>
            </div>
        </div>
        {{-- Tổng tiền --}}
        <div class="card">
            <div class="card-body">
                <p>Tạm tính: <strong>{{ number_format($tamTinh,0,',','.') }} đ</strong></p>
                <p>Phí ship: <strong>{{ number_format($phiShip,0,',','.') }} đ</strong></p>
                <hr>
                <p class="fs-5">
                    Tổng cộng:
                    <strong class="text-primary">
                        {{ number_format($tong,0,',','.') }} đ
                    </strong>
                </p>
                <button type="button"
                    class="btn btn-success w-100 py-2"
                    onclick="xacNhanDatHang()">
                    <i class="fa fa-check me-2"></i>Xác nhận đặt hàng
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
function xacNhanDatHang() {
    if (!confirm('Bạn có chắc chắn muốn đặt hàng không?')) return;
    document.getElementById('formDatHang').submit();
}
</script>
@endpush
