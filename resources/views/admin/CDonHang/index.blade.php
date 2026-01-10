@extends('admin.layouts.app')

@section('content')
<h4>CDonHang – Quản lý đơn hàng</h4>

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>MaDH</th>
            <th>MaKH</th>
            <th>NgayDat</th>
            <th>TrangThai</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>DH01</td>
            <td>KH01</td>
            <td>01/01/2026</td>
            <td>Đang xử lý</td>
        </tr>
    </tbody>
</table>
@endsection
