@extends('admin.layouts.app')

@section('content')
<h4>CDanhMuc – Quản lý danh mục</h4>

<table class="table table-bordered bg-white">
    <thead>
        <tr>
            <th>MaDM</th>
            <th>TenDM</th>
            <th>MoTa</th>
            <th>IsDeleted</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Giày thể thao</td>
            <td>Danh mục giày</td>
            <td>false</td>
        </tr>
    </tbody>
</table>
@endsection
