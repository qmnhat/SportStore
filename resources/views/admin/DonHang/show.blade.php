@extends('admin.layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')

<div class="page-heading mb-4">
    <h3>Chi tiết đơn hàng #DH{{ $donHang->MaDH }}</h3>
</div>

<div class="card">
    <div class="card-body">

        <p><strong>Khách hàng:</strong> {{ $donHang->khachHang->HoTen ?? '---' }}</p>
        <p><strong>Ngày đặt:</strong> {{ $donHang->NgayDat->format('d/m/Y') }}</p>

        <p><strong>Trạng thái:</strong>
            @switch($donHang->TrangThai)
                @case(0) <span class="badge bg-warning text-dark">Chờ xác nhận</span> @break
                @case(1) <span class="badge bg-info text-dark">Đang giao</span> @break
                @case(2) <span class="badge bg-success">Hoàn thành</span> @break
                @case(3) <span class="badge bg-danger">Đã hủy</span> @break
            @endswitch
        </p>

        <a href="{{ route('admin.donhang.index') }}" class="btn btn-secondary mt-3">
            Quay lại
        </a>

    </div>
</div>

@endsection
