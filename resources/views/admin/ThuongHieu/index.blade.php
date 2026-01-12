@extends('admin.layouts.app')

@section('title', 'Quản lý thương hiệu')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý thương hiệu</h3>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Danh sách thương hiệu</h4>
                    <a href="#" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm thương hiệu
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:80px;">Mã TH</th>
                                <th>Tên thương hiệu</th>
                                <th>Mô tả</th>
                                <th style="width:120px;">Trạng thái</th>
                                <th style="width:140px;" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Demo thương hiệu --}}
                            <tr>
                                <td>TH01</td>
                                <td>Nike</td>
                                <td>Thương hiệu thể thao Mỹ</td>
                                <td><span class="badge bg-success">Hoạt động</span></td>
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
                                <td>TH02</td>
                                <td>Adidas</td>
                                <td>Thương hiệu thể thao Đức</td>
                                <td><span class="badge bg-success">Hoạt động</span></td>
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
                                <td>TH03</td>
                                <td>Puma</td>
                                <td>Thương hiệu thể thao Đức</td>
                                <td><span class="badge bg-danger">Ngừng hoạt động</span></td>
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
