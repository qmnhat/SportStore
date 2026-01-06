@extends('layouts.app')

@section('title', 'Tình trạng đơn hàng')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">
                    <i class="fa fa-truck me-2"></i>Tình trạng đơn hàng
                </h3>

                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th class="text-end">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- ĐƠN HÀNG GIẢ – sau này thay bằng DB --}}
                                <tr>
                                    <td>#DH001</td>
                                    <td>06/01/2026</td>
                                    <td>2.500.000 ₫</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            Chờ xác nhận
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="/don-hang/1" class="btn btn-sm btn-outline-primary">
                                            Xem
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>#DH002</td>
                                    <td>04/01/2026</td>
                                    <td>1.200.000 ₫</td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            Đang giao
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="/don-hang/2" class="btn btn-sm btn-outline-primary">
                                            Xem
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>#DH003</td>
                                    <td>01/01/2026</td>
                                    <td>3.800.000 ₫</td>
                                    <td>
                                        <span class="badge bg-success">
                                            Hoàn thành
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="/don-hang/3" class="btn btn-sm btn-outline-primary">
                                            Xem
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
