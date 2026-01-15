@extends('admin.layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý đơn hàng</h3>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="mb-0">Danh sách đơn hàng</h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Mã khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Demo đơn hàng --}}
                            <tr>
                                <td>DH01</td>
                                <td>KH01</td>
                                <td>01/01/2026</td>
                                <td><span class="badge bg-warning text-dark">Đang xử lý</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" disabled>
                                        <i class="bi bi-check-circle"></i> Duyệt
                                    </button>
                                    <button class="btn btn-sm btn-danger" disabled>
                                        <i class="bi bi-x-circle"></i> Hủy
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>DH02</td>
                                <td>KH02</td>
                                <td>02/01/2026</td>
                                <td><span class="badge bg-success">Đã duyệt</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" disabled>
                                        <i class="bi bi-check-circle"> Duyệt</i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" disabled>
                                        <i class="bi bi-x-circle"> Hủy</i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>DH03</td>
                                <td>KH03</td>
                                <td>03/01/2026</td>
                                <td><span class="badge bg-danger">Đã hủy</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success" disabled>
                                        <i class="bi bi-check-circle"> Duyệt</i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" disabled>
                                        <i class="bi bi-x-circle"> Hủy</i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
