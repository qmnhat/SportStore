@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        {{-- Cột trái: Danh sách sản phẩm trong giỏ --}}
        <div class="col-lg-8">
            <h3 class="mb-4">
                <i class="fa fa-shopping-cart me-2"></i>Giỏ hàng
            </h3>

            <div class="card border-0 shadow-sm">
                <div class="card-body">
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
                                {{-- ITEM GIẢ (tĩnh) - sau này thay bằng DB --}}
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/70x70"
                                                class="rounded border me-3" alt="sp" />
                                            <div>
                                                <div class="fw-semibold">Áo thể thao Nike</div>
                                                <div class="text-muted small">Mã: SP001</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="input-group input-group-sm justify-content-center" style="max-width: 140px; margin: 0 auto;">
                                            <button class="btn btn-outline-secondary" type="button">-</button>
                                            <input type="text" class="form-control text-center" value="1" />
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </td>

                                    <td class="text-end">350.000 ₫</td>
                                    <td class="text-end fw-semibold">350.000 ₫</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://via.placeholder.com/70x70"
                                                class="rounded border me-3" alt="sp" />
                                            <div>
                                                <div class="fw-semibold">Giày chạy bộ</div>
                                                <div class="text-muted small">Mã: SP002</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="input-group input-group-sm justify-content-center" style="max-width: 140px; margin: 0 auto;">
                                            <button class="btn btn-outline-secondary" type="button">-</button>
                                            <input type="text" class="form-control text-center" value="2" />
                                            <button class="btn btn-outline-secondary" type="button">+</button>
                                        </div>
                                    </td>

                                    <td class="text-end">600.000 ₫</td>
                                    <td class="text-end fw-semibold">1.200.000 ₫</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                {{-- END --}}
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/san-pham" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left me-2"></i>Tiếp tục mua hàng
                        </a>

                        <button class="btn btn-outline-secondary">
                            <i class="fa fa-sync me-2"></i>Cập nhật giỏ
                        </button>
                    </div>
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
                        <span class="fw-semibold">1.550.000 ₫</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển</span>
                        <span class="fw-semibold">30.000 ₫</span>
                    </div>

                    <hr />

                    <div class="d-flex justify-content-between mb-3">
                        <span class="fs-5 fw-bold">Tổng cộng</span>
                        <span class="fs-5 fw-bold text-primary">1.580.000 ₫</span>
                    </div>

                    <button class="btn btn-primary w-100 py-2">
                        <i class="fa fa-credit-card me-2"></i>Tiến hành thanh toán
                    </button>

                    <div class="text-muted small mt-3">
                        * Đây là giao diện tĩnh. Khi làm DB/Controller, bạn sẽ thay dữ liệu bảng + tổng tiền.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
