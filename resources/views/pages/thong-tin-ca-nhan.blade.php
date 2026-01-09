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
@endsection
