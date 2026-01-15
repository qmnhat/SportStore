@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h4>Thêm thương hiệu</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.thuonghieu.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Tên thương hiệu</label>
                <input type="text" name="TenTH" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="MoTa" class="form-control" rows="3"></textarea>
            </div>

            <button class="btn btn-primary">Lưu</button>
            <a href="{{ route('admin.thuonghieu.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
