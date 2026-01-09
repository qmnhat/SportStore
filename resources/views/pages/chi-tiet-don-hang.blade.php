@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">

                {{-- TIÊU ĐỀ --}}
                <div class="mb-4">
                    <h3 class="mb-0">
                        <i class="fa fa-receipt me-2"></i>Chi tiết đơn hàng #DH001
                    </h3>
                </div>

                {{-- THÔNG TIN ĐƠN HÀNG --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Ngày đặt:</strong> 06/01/2026
                            </div>
                            <div class="col-md-4">
                                <strong>Trạng thái:</strong>
                                <span class="badge bg-warning text-dark">
                                    Chờ xác nhận
                                </span>
                            </div>
                            <div class="col-md-4">
                                <strong>Tổng tiền:</strong> 2.500.000 ₫
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BẢNG CHI TIẾT --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Kích thước</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Giày thể thao Nike Air</td>
                                    <td>42</td>
                                    <td>1</td>
                                    <td>1.500.000 ₫</td>
                                    <td class="text-end">1.500.000 ₫</td>
                                </tr>
                                <tr>
                                    <td>Áo thể thao Adidas</td>
                                    <td>L</td>
                                    <td>2</td>
                                    <td>500.000 ₫</td>
                                    <td class="text-end">1.000.000 ₫</td>
                                </tr>
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="4" class="text-end">Tổng cộng</th>
                                    <th class="text-end">2.500.000 ₫</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- NÚT QUAY LẠI Ở DƯỚI – BÊN PHẢI --}}
                <div class="mt-4 d-flex justify-content-end">
                    <a href="/don-hang" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i>Quay lại
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection
