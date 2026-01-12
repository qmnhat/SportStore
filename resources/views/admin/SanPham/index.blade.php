@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')

    <div class="page-heading mb-4">
        <h3>Quản lý sản phẩm</h3>
    </div>

    {{-- Tab tĩnh --}}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">Hiện tại</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Đã xóa</a>
        </li>
    </ul>

    {{-- Danh sách Active --}}
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Giày Nike Air</td>
                        <td>Giày thể thao</td>
                        <td>Nike</td>
                        <td><span class="badge bg-success">Hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-danger" disabled>
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Giày Adidas Run</td>
                        <td>Giày thể thao</td>
                        <td>Adidas</td>
                        <td><span class="badge bg-success">Hoạt động</span></td>
                        <td>
                            <button class="btn btn-sm btn-danger" disabled>
                                <i class="bi bi-trash"></i> Xóa
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Danh sách Deleted --}}
    <div class="card">
        <div class="card-header">
            <h5>Danh sách đã xóa</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>3</td>
                        <td>Giày Puma Classic</td>
                        <td>Giày thể thao</td>
                        <td>Puma</td>
                        <td><span class="badge bg-danger">Đã xóa</span></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-success" disabled>
                                <i class="bi bi-arrow-counterclockwise"></i> Khôi phục
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
