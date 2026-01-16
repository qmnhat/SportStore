@extends('admin.layouts.app')

@section('title', 'Quản lý Thông tin công ty')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-gear"></i> Quản lý Thông tin công ty
                    </h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.company-info.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Tên công ty -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên công ty</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ old('name', $company->name ?? '') }}" required>
                        </div>

                        <!-- Mô tả -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="2">{{ old('description', $company->description ?? '') }}</textarea>
                        </div>

                        <!-- Địa chỉ -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ</label>
                            <input type="text" name="address" class="form-control"
                                   value="{{ old('address', $company->address ?? '') }}" required>
                        </div>

                        <!-- Hotline -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hotline</label>
                                <input type="text" name="hotline" class="form-control"
                                       value="{{ old('hotline', $company->hotline ?? '') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $company->email ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Mã số thuế -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Mã số thuế</label>
                                <input type="text" name="tax_code" class="form-control"
                                       value="{{ old('tax_code', $company->tax_code ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Giờ mở cửa</label>
                                <input type="text" name="opening_hours" class="form-control"
                                       value="{{ old('opening_hours', $company->opening_hours ?? '') }}">
                            </div>
                        </div>

                        <!-- Tầm nhìn -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tầm nhìn</label>
                            <textarea name="vision" class="form-control" rows="3">{{ old('vision', $company->vision ?? '') }}</textarea>
                        </div>

                        <!-- Sứ mệnh -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Sứ mệnh</label>
                            <textarea name="mission" class="form-control" rows="3">{{ old('mission', $company->mission ?? '') }}</textarea>
                        </div>

                        <!-- Số nhân viên -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số nhân viên</label>
                            <input type="number" name="employee_count" class="form-control"
                                   value="{{ old('employee_count', $company->employee_count ?? '') }}">
                        </div>

                        <hr>

                        <!-- Mạng xã hội -->
                        <h5 class="mb-3">Liên kết Mạng xã hội</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Facebook</label>
                                <input type="url" name="facebook_url" class="form-control"
                                       value="{{ old('facebook_url', $company->facebook_url ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Instagram</label>
                                <input type="url" name="instagram_url" class="form-control"
                                       value="{{ old('instagram_url', $company->instagram_url ?? '') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Twitter</label>
                                <input type="url" name="twitter_url" class="form-control"
                                       value="{{ old('twitter_url', $company->twitter_url ?? '') }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">YouTube</label>
                                <input type="url" name="youtube_url" class="form-control"
                                       value="{{ old('youtube_url', $company->youtube_url ?? '') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Zalo</label>
                            <input type="text" name="zalo_phone" class="form-control"
                                   value="{{ old('zalo_phone', $company->zalo_phone ?? '') }}">
                        </div>

                        <hr>

                        <!-- Button -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
