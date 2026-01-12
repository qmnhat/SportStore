@extends('admin.layouts.app')

@section('title', 'Quản lý khuyến mãi')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý khuyến mãi</h3>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Danh sách khuyến mãi</h4>
                    <a href="#" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm khuyến mãi
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:80px;">Mã KM</th>
                                <th>Tên KM</th>
                                <th>Giá trị giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th style="width:120px;">Trạng thái</th>
                                <th style="width:140px;" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Demo khuyến mãi --}}
                            <tr>
                                <td>KM01</td>
                                <td>Sale Tết</td>
                                <td>20%</td>
                                <td>01/01/2026</td>
                                <td>10/01/2026</td>
                                <td><span class="badge bg-success">Đang áp dụng</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" disabled>
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" disabled>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>KM02</td>
                                <td>Sale hè</td>
                                <td>15%</td>
                                <td>01/06/2026</td>
                                <td>15/06/2026</td>
                                <td><span class="badge bg-secondary">Chưa áp dụng</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" disabled>
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" disabled>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>KM03</td>
                                <td>Sale cuối năm</td>
                                <td>25%</td>
                                <td>01/12/2025</td>
                                <td>31/12/2025</td>
                                <td><span class="badge bg-danger">Đã hết hạn</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" disabled>
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" disabled>
                                        <i class="bi bi-trash"></i>
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
