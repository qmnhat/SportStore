@extends('admin.layouts.app')

@section('title', 'Sửa thương hiệu')

@section('content')
    <div class="page-heading mb-4">
        <h3>Sửa thương hiệu: {{ $thuonghieu->TenTH }}</h3>
    </div>

    <div class="card">
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

            <form action="{{ route('admin.thuonghieu.update', $thuonghieu->MaTH) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Tên thương hiệu</label>
                    <input type="text" name="TenTH" class="form-control" value="{{ old('TenTH', $thuonghieu->TenTH) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả</label>
                    <textarea name="MoTa" class="form-control" rows="3">{{ old('MoTa', $thuonghieu->MoTa) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.thuonghieu.index') }}" class="btn btn-secondary">
                        Quay lại
                    </a>
                    <button class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
