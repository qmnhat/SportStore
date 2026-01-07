@extends('admin.layouts.app')

@section('content')
<h4>CThuongHieu – Quản lý thương hiệu</h4>

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>MaTH</th>
            <th>TenTH</th>
            <th>MoTa</th>
            <th>TrangThai</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>TH01</td>
            <td>Nike</td>
            <td>Thương hiệu thể thao Mỹ</td>
            <td>Hoạt động</td>
        </tr>
        <tr>
            <td>TH02</td>
            <td>Adidas</td>
            <td>Thương hiệu thể thao Đức</td>
            <td>Hoạt động</td>
        </tr>
    </tbody>
</table>
@endsection
