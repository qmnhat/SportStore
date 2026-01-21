@extends('layouts.app')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-user me-2"></i>Thông tin cá nhân
                        </h4>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="/thong-tin-ca-nhan">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Họ tên</label>
                                <div class="col-sm-9">
                                    <input type="text" name="HoTen" class="form-control" value="{{ $kh->HoTen }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" value="{{ $kh->Email }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Ngày sinh</label>
                                <div class="col-sm-9">
                                    <input type="date" name="NgaySinh" class="form-control" value="{{ $kh->NgaySinh }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" name="SDT" class="form-control" value="{{ $kh->SDT }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <textarea name="DiaChi" class="form-control" rows="3">{{ $kh->DiaChi }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Giới tính</label>
                                <div class="col-sm-9">
                                    <select name="GioiTinh" class="form-select">
                                        <option value="">-- Chọn giới tính --</option>
                                        <option value="1" {{ (int) $kh->GioiTinh === 1 ? 'selected' : '' }}>Nam</option>
                                        <option value="0" {{ (int) $kh->GioiTinh === 0 ? 'selected' : '' }}>Nữ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="button" class="btn btn-outline-secondary me-2" onclick="history.back()">
                                    Hủy
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

<hr class="my-4">

<h5 class="mb-3">
    <i class="fas fa-heart text-danger me-2"></i>
    Sản phẩm yêu thích
</h5>

@if($sanPhamYeuThich->count() > 0)
    <div class="list-group">
        @foreach($sanPhamYeuThich as $sp)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $sp->TenSP }}</strong>
                    <div class="text-muted small">
                        Giá: {{ number_format($sp->GiaBan) }}đ
                    </div>
                </div>

                <a href="{{ route('sanpham.chitiet', $sp->MaSP) }}"
                   class="btn btn-sm btn-outline-primary">
                    Xem
                </a>
            </div>
        @endforeach
    </div>
@else
    <p class="text-muted fst-italic">
        Bạn chưa có sản phẩm yêu thích nào.
    </p>
@endif










@endsection
