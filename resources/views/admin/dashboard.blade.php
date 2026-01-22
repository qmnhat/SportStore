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
                            <h6 class="font-extrabold mb-0">{{ $tongSanPham }}</h6>
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
                            <h6 class="font-extrabold mb-0">{{ $tongDonHang }}</h6>
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
                            <h6 class="font-extrabold mb-0">{{ number_format($tongDoanhThu, 0, ',', '.') }} ₫</h6>
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
                            <h6 class="font-extrabold mb-0">{{ $tongNguoiDung }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Biểu đồ --}}
    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-bar-chart-line me-2 text-primary"></i>
                Tổng quan doanh thu
            </h5>
        </div>

        <div class="row g-4 mt-4">
            {{-- DOANH THU --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold text-success">
                        <i class="bi bi-cash-stack me-2"></i>Doanh thu
                    </div>
                    <div class="card-body">
                        <canvas id="chartDoanhThu" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- ĐƠN HÀNG --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold text-primary">
                        <i class="bi bi-receipt me-2"></i>Đơn hàng
                    </div>
                    <div class="card-body">
                        <canvas id="chartDonHang" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- SẢN PHẨM --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold text-warning">
                        <i class="bi bi-box me-2"></i>Sản phẩm
                    </div>
                    <div class="card-body">
                        <canvas id="chartSanPham" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- NGƯỜI DÙNG --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold text-danger">
                        <i class="bi bi-people me-2"></i>Người dùng
                    </div>
                    <div class="card-body">
                        <canvas id="chartNguoiDung" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    function renderSingleBarChart(id, label, value, color) {
        new Chart(document.getElementById(id), {
            type: 'bar',
            data: {
                labels: [label],
                datasets: [{
                    data: [value],
                    backgroundColor: color,
                    borderRadius: 8,
                    barThickness: 50
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => value.toLocaleString('vi-VN')
                        }
                    }
                }
            }
        });
    }

    renderSingleBarChart(
        'chartDoanhThu',
        'Doanh thu',
        {{ $tongDoanhThu }},
        '#28c76f'
    );

    renderSingleBarChart(
        'chartDonHang',
        'Đơn hàng',
        {{ $tongDonHang }},
        '#0d6efd'
    );

    renderSingleBarChart(
        'chartSanPham',
        'Sản phẩm',
        {{ $tongSanPham }},
        '#ffc107'
    );

    renderSingleBarChart(
        'chartNguoiDung',
        'Người dùng',
        {{ $tongNguoiDung }},
        '#ea5455'
    );
    </script>
@endsection
