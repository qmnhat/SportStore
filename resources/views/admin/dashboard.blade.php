@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="stats-icon purple">
                                <i class="bi bi-box"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Sản phẩm</h6>
                            <h6 class="font-extrabold mb-0">120</h6>
                            {{-- 120 là số demo, không phải dữ liệu thật --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="stats-icon blue">
                                <i class="bi bi-receipt"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Đơn hàng</h6>
                            <h6 class="font-extrabold mb-0">45</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="stats-icon green">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Doanh thu</h6>
                            <h6 class="font-extrabold mb-0">—</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <div class="stats-icon red">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="col-8">
                            <h6 class="text-muted font-semibold">Người dùng</h6>
                            <h6 class="font-extrabold mb-0">—</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Biểu đồ --}}
    <div class="card mt-4">
        <div class="card-header">
            <h4>Tổng quan doanh thu</h4>
        </div>
        <div class="card-body">
            <div class="border rounded d-flex align-items-center justify-content-center" style="height:280px;">
                <span class="text-muted">Khu vực biểu đồ (làm sau)</span>
            </div>
        </div>
    </div>

@endsection
