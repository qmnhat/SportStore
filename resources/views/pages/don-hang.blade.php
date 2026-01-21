

@extends('layouts.app')

@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="container py-5">

        {{-- TIÊU ĐỀ --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">
                <i class="fa fa-shopping-cart me-2"></i>Danh sách đơn hàng
            </h3>
        </div>

        {{-- BỘ LỌC --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" class="row g-3 align-items-end">

                    {{-- Trạng thái --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="trangthai" class="form-select">
                            <option value="all" {{ request('trangthai') == 'all' ? 'selected' : '' }}>Tất cả</option>
                            <option value="0" {{ request('trangthai') == '0' ? 'selected' : '' }}>Chờ xác nhận</option>
                            <option value="1" {{ request('trangthai') == '1' ? 'selected' : '' }}>Đang giao</option>
                            <option value="2" {{ request('trangthai') == '2' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="3" {{ request('trangthai') == '3' ? 'selected' : '' }}>Đã hủy</option>
                        </select>


                    </div>

                    {{-- Sắp xếp --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Sắp xếp theo ngày</label>
                        <select name="sort" class="form-select">
                            <option value="new" {{ request('sort') === 'new' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="old" {{ request('sort') === 'old' ? 'selected' : '' }}>Cũ nhất</option>
                        </select>
                    </div>

                    {{-- Nút --}}
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100">
                            <i class="fa fa-filter me-2"></i>Lọc đơn hàng
                        </button>
                    </div>

                </form>

            </div>
        </div>

        {{-- BẢNG --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">

                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th class="text-end pe-4">Chi tiết</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($donHangs as $dh)
                            <tr>
                                <td class="ps-4 fw-semibold">
                                    #DH{{ $dh->MaDH }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($dh->NgayDat)->format('d/m/Y') }}
                                </td>

                                <td>
                                    @if ($dh->TrangThai == 0)
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            Chờ xác nhận
                                        </span>
                                    @elseif ($dh->TrangThai == 1)
                                        <span class="badge bg-info text-dark px-3 py-2">
                                            Đang giao
                                        </span>
                                    @elseif ($dh->TrangThai == 2)
                                        <span class="badge bg-success px-3 py-2">
                                            Hoàn thành
                                        </span>
                                    @elseif ($dh->TrangThai == 3)
                                        <span class="badge bg-danger px-3 py-2">
                                            Đã hủy
                                        </span>
                                    @endif
                                </td>

                                {{-- CỘT THAO TÁC --}}
                                <td class="text-end pe-4">

                                    <a href="{{ route('donhang.show', $dh->MaDH) }}"
                                        class="btn btn-sm btn-outline-primary me-1">
                                        Xem
                                    </a>

                                    @if ($dh->TrangThai == 0)
                                        <form action="{{ route('donhang.huy', $dh->MaDH) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Bạn chắc chắn muốn hủy đơn này?')">
                                                Hủy
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fa fa-box-open me-2"></i>Không có đơn hàng
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection
