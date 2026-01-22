@extends('admin.layouts.app')

@section('title', 'Sửa khách hàng')

@section('content')

    <div class="page-heading mb-4">
        <h3>Sửa khách hàng: {{ $kh->HoTen }}</h3>
    </div>

                    <label for="Email" class="form-label">Email</label>
                    <input type="email" name="Email" id="Email" class="form-control"
                        value="{{ old('Email', $kh->Email) }}" required>
                </div>

                <div class="mb-3">
                    <label for="DiaChi" class="form-label">Địa chỉ</label>
                    <input type="text" name="DiaChi" id="DiaChi" class="form-control"
                        value="{{ old('DiaChi', $kh->DiaChi) }}">
                </div>

                <div class="mb-3">
                    <label for="SDT" class="form-label">Số điện thoại</label>
                    <input type="text" name="SDT" id="SDT" class="form-control"
                        value="{{ old('SDT', $kh->SDT) }}">
                </div>

                <div class="mb-3">
                    <label for="NgaySinh" class="form-label">Ngày sinh</label>
                    <input type="date" name="NgaySinh" id="NgaySinh" class="form-control"
                        value="{{ old('NgaySinh', $kh->NgaySinh?->format('Y-m-d')) }}">
                </div>

                <div class="mb-3">
                    <label for="TrangThai" class="form-label">Trạng thái</label>
                    <select name="TrangThai" id="TrangThai" class="form-select">
                        <option value="1" {{ $kh->TrangThai ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ !$kh->TrangThai ? 'selected' : '' }}>Blocked</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.khachhang.index') }}" class="btn btn-secondary">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

@endsection
