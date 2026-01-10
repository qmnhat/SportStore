@extends('admin.layouts.app')

@section('content')
<h4>CKhuyenMai – Quản lý khuyến mãi</h4>

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>MaKM</th>
            <th>TenKM</th>
            <th>GiaTriGiam</th>
            <th>NgayBatDau</th>
            <th>NgayKetThuc</th>
            <th>TrangThai</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>KM01</td>
            <td>Sale Tết</td>
            <td>20%</td>
            <td>01/01/2026</td>
            <td>10/01/2026</td>
            <td>Đang áp dụng</td>
        </tr>
    </tbody>
</table>
@endsection
