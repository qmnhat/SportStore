@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')

@section('content')

    {{-- Page heading --}}
    <div class="page-heading mb-4">
        <h3>Quản lý danh mục</h3>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Danh sách danh mục</h4>
                    <a href="#" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i> Thêm danh mục
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:80px;">Mã</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th style="width:120px;">Trạng thái</th>
                                <th style="width:140px;" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Demo data – chưa nối DB --}}
                            <tr>
                                <td>1</td>
                                <td>Giày thể thao</td>
                                <td>Danh mục giày</td>
                                <td>
                                    <span class="badge bg-success">Hoạt động</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

@endsection
