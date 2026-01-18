@extends('layouts.app')
@section('title', $baiViet->TieuDe)
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">

                {{-- TIÊU ĐỀ BÀI VIẾT --}}
                <div class="mb-4">
                    <h1 class="mb-0">{{ $baiViet->TieuDe }}</h1>
                    <small class="text-muted">
                        Đăng ngày {{ $baiViet->created_at->format('d/m/Y') }}
                    </small>
                </div>
                {{-- NỘI DUNG BÀI VIẾT --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        {!! nl2br(e($baiViet->NoiDung)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
