@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <div class="container py-5">

        <div class="row">
            <div class="col-12">

                <h3 class="mb-4">
                    <i class="fa fa-receipt me-2"></i>Chi tiết đơn hàng #DH{{ $donHang->MaDH }}
                </h3>

                {{-- Thông tin đơn --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <strong>Ngày đặt:</strong>
                                {{ \Carbon\Carbon::parse($donHang->NgayDat)->format('d/m/Y') }}
                            </div>

                            <div class="col-md-6">
                                <strong>Trạng thái:</strong>

                                @if ($donHang->TrangThai == 0)
                                    <span class="badge bg-warning text-dark">Chờ xác nhận</span>
                                @elseif($donHang->TrangThai == 1)
                                    <span class="badge bg-info text-dark">Đang giao</span>
                                @elseif($donHang->TrangThai == 2)
                                    <span class="badge bg-success">Hoàn thành</span>
                                @elseif($donHang->TrangThai == 3)
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Bảng sản phẩm --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">

                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php $tongTien = 0; @endphp

                                @foreach ($chiTiet as $ct)
                                    @php
                                        $thanhTien = $ct->GiaGoc * $ct->SoLuong;
                                        $tongTien += $thanhTien;
                                    @endphp

                                    <tr>
                                        <td>{{ $ct->TenSP }}</td>

                                        <td>{{ number_format($ct->GiaGoc) }} ₫</td>

                                        <td>{{ $ct->SoLuong }}</td>

                                        <td class="text-end">
                                            {{ number_format($thanhTien) }} ₫
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Tổng cộng:</th>
                                    <th class="text-end text-danger">
                                        {{ number_format($tongTien) }} ₫
                                    </th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>

                {{-- Nút quay lại --}}
                <div class="mt-4">
                    <a href="{{ route('donhang.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-2"></i>Quay lại
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
