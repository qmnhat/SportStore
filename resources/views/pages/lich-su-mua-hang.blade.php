@extends('layouts.app')

@section('title', 'Lịch sử mua hàng')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">
                <i class="fa fa-history me-2"></i>Lịch sử mua hàng
            </h3>

            {{-- Bộ lọc (UI tĩnh) --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Từ ngày</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Đến ngày</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-primary w-100">
                                <i class="fa fa-filter me-2"></i>Lọc
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bảng lịch sử --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Ngày mua</th>
                                <th>Số sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Xem chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- DỮ LIỆU GIẢ --}}
                            <tr>
                                <td>#DH010</td>
                                <td>02/01/2026</td>
                                <td>3</td>
                                <td>1.850.000 ₫</td>
                                <td>
                                    <span class="badge bg-success">Hoàn thành</span>
                                </td>
                                <td class="text-end">
                                    <a href="/don-hang/10" class="btn btn-sm btn-outline-primary">Xem</a>
                                </td>
                            </tr>

                            <tr>
                                <td>#DH009</td>
                                <td>29/12/2025</td>
                                <td>1</td>
                                <td>350.000 ₫</td>
                                <td>
                                    <span class="badge bg-danger">Đã hủy</span>
                                </td>
                                <td class="text-end">
                                    <a href="/don-hang/9" class="btn btn-sm btn-outline-primary">Xem</a>
                                </td>
                            </tr>
                            {{-- END --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
