@extends('layouts.app')
@section('title', 'Blog - Tin tức và bài viết')
@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="section-title mb-5">
                <h2 class="text-center">Blog & Tin Tức</h2>
                <p class="text-center text-muted">Cập nhật những bài viết mới nhất từ chúng tôi</p>
            </div>
        </div>
    </div>

    {{-- Tìm kiếm --}}
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form method="GET" action="{{ route('blog.index') }}" class="d-flex gap-2">
                <input type="text" name="q" class="form-control" placeholder="Tìm bài viết..." value="{{ request('q') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Tìm
                </button>
                @if(request('q'))
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Danh sách bài viết --}}
    <div class="row">
        @forelse($baiviet as $post)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow">
                    {{-- Hình ảnh --}}
                    @if($post->HinhAnh && file_exists(public_path($post->HinhAnh)))
                        <img src="{{ asset($post->HinhAnh) }}" class="card-img-top" alt="{{ $post->TieuDe }}" style="height: 250px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                            <i class="bi bi-image" style="font-size: 3rem; color: #ddd;"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        {{-- Tiêu đề --}}
                        <h5 class="card-title">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark">
                                {{ Str::limit($post->TieuDe, 60) }}
                            </a>
                        </h5>

                        {{-- Tóm tắt --}}
                        <p class="card-text text-muted flex-grow-1">
                            {{ $post->TomTat ? Str::limit($post->TomTat, 100) : Str::limit(strip_tags($post->NoiDung), 100) }}
                        </p>

                        {{-- Thông tin --}}
                        <div class="small text-muted mb-3">
                            <i class="bi bi-calendar"></i>
                            {{ $post->NgayTao->format('d/m/Y') }}
                            @if($post->author)
                                <span class="ms-2">
                                    <i class="bi bi-person"></i>
                                    {{ $post->author->name ?? 'Tác giả' }}
                                </span>
                            @endif
                        </div>

                        {{-- Nút xem chi tiết --}}
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-outline-primary mt-auto">
                            Xem chi tiết <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    @if(request('q'))
                        Không tìm thấy bài viết nào với từ khóa "{{ request('q') }}"
                    @else
                        Hiện chưa có bài viết nào.
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    {{-- Phân trang --}}
    @if($baiviet->count() > 0)
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $baiviet->withQueryString()->links() }}
            </div>
        </div>
    @endif
</div>

<style>
    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-3px);
    }

    .section-title h2 {
        position: relative;
        display: inline-block;
        left: 50%;
        transform: translateX(-50%);
        font-weight: 700;
        color: #333;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #007bff;
    }
</style>
@endsection
