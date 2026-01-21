@extends('admin.layouts.app')

@section('title', 'Quản lý đơn hàng')

@section('content')

<div class="page-heading mb-4">
    <h3>Quản lý đơn hàng</h3>
</div>

{{-- Tìm kiếm + Lọc + Sắp xếp --}}
<div class="row mb-3">

    {{-- Tìm theo mã đơn --}}
    <div class="col-md-4">
        <form method="GET" action="{{ route('admin.donhang.index') }}" class="d-flex">
            <input type="text" name="q" class="form-control me-2"
                   placeholder="Tìm theo mã đơn (#DH...)"
                   value="{{ request('q') }}">
            <button class="btn btn-primary">Tìm</button>
        </form>
    </div>

    {{-- Lọc trạng thái --}}
    <div class="col-md-3">
        <form method="GET" action="{{ route('admin.donhang.index') }}">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Trạng thái --</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Chờ xác nhận</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Đang giao</option>
                <option value="2" {{ request('status') === '2' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="3" {{ request('status') === '3' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </form>
    </div>

    {{-- Sắp xếp --}}
    <div class="col-md-3">
        <form method="GET" action="{{ route('admin.donhang.index') }}">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="">-- Sắp xếp --</option>
                <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Mới nhất</option>
                <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Cũ nhất</option>
            </select>
        </form>
    </div>

    <div class="col-md-2 text-end">
        <a href="{{ route('admin.donhang.index') }}" class="btn btn-secondary">Làm mới</a>
    </div>

</div>

{{-- TAB --}}
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#active">
            Đơn hàng đang xử lý
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancelled">
            Đơn hàng đã hủy
        </button>
    </li>
</ul>

<div class="tab-content">

{{-- TAB ĐANG XỬ LÝ --}}
<div class="tab-pane fade show active" id="active">
    <div class="card">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @forelse($donHangActive as $dh)
                    <tr>
                        <td>#DH{{ $dh->MaDH }}</td>
                        <td>{{ $dh->khachHang->HoTen ?? '---' }}</td>
                        <td>{{ $dh->NgayDat->format('d/m/Y') }}</td>
                        <td>
                            @switch($dh->TrangThai)
                                @case(0) <span class="badge bg-warning text-dark">Chờ xác nhận</span> @break
                                @case(1) <span class="badge bg-info text-dark">Đang giao</span> @break
                                @case(2) <span class="badge bg-success">Hoàn thành</span> @break
                            @endswitch
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.donhang.show', $dh->MaDH) }}"
                               class="btn btn-sm btn-primary">
                                Xem
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.donhang.cancel', $dh->MaDH) }}"
                                  class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hủy đơn hàng này?')">
                                    Hủy
                                </button>
                            </form>
                            <form action="{{ route('admin.donhang.updateStatus', $dh->MaDH) }}"
                                method="POST" class="d-inline">
                                @csrf

                                <select name="TrangThai"
                                        class="form-select form-select-sm"
                                        onchange="this.form.submit()">

                                    <option value="0" {{ $dh->TrangThai == 0 ? 'selected' : '' }}>
                                        Chờ xác nhận
                                    </option>

                                    <option value="1" {{ $dh->TrangThai == 1 ? 'selected' : '' }}>
                                        Đang giao
                                    </option>

                                    <option value="2" {{ $dh->TrangThai == 2 ? 'selected' : '' }}>
                                        Hoàn thành
                                    </option>

                                    <option value="3" {{ $dh->TrangThai == 3 ? 'selected' : '' }}>
                                        Đã hủy
                                    </option>

                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Không có đơn hàng</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $donHangActive->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- TAB ĐÃ HỦY --}}
<div class="tab-pane fade" id="cancelled">
    <div class="card">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @forelse($donHangCancelled as $dh)
                    <tr>
                        <td>#DH{{ $dh->MaDH }}</td>
                        <td>{{ $dh->khachHang->HoTen ?? '---' }}</td>
                        <td>{{ $dh->NgayDat->format('d/m/Y') }}</td>
                        <td><span class="badge bg-danger">Đã hủy</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Không có dữ liệu</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $donHangCancelled->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

</div>

@endsection
