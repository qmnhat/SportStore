@extends('layouts.app')
@section('title', $baiViet->TieuDe)
@section('content')
<div class="container my-5">
    <div class="row">
        {{-- Nội dung chính --}}
        <div class="col-md-8">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($baiViet->TieuDe, 50) }}</li>
                </ol>
            </nav>

            {{-- Hình ảnh --}}
            @if($baiViet->HinhAnh && file_exists(public_path($baiViet->HinhAnh)))
                <img src="{{ asset($baiViet->HinhAnh) }}" alt="{{ $baiViet->TieuDe }}" class="img-fluid mb-4 rounded" style="max-height: 500px; width: 100%; object-fit: cover;">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center mb-4 rounded" style="height: 400px;">
                    <i class="bi bi-image" style="font-size: 5rem; color: #ddd;"></i>
                </div>
            @endif

            {{-- Tiêu đề --}}
            <h1 class="mb-3">{{ $baiViet->TieuDe }}</h1>

            {{-- Thông tin bài viết --}}
            <div class="post-meta mb-4 pb-3 border-bottom">
                <span class="me-3">
                    <i class="bi bi-calendar"></i>
                    {{ $baiViet->NgayTao->format('d/m/Y') }}
                </span>
                @if($baiViet->author)
                    <span class="me-3">
                        <i class="bi bi-person"></i>
                        {{ $baiViet->author->name ?? 'Tác giả' }}
                    </span>
                @endif
                <span>
                    <i class="bi bi-tag"></i>
                    <span class="badge bg-primary">Blog</span>
                </span>
            </div>

            {{-- Nội dung --}}
            <div class="post-content">
                {!! $baiViet->NoiDung !!}
            </div>

            {{-- Nút chia sẻ --}}
            <div class="share-buttons mt-5 pt-4 border-top">
                <h5 class="mb-3">Chia sẻ bài viết:</h5>
                <div class="d-flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog.show', $baiViet->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ route('blog.show', $baiViet->slug) }}&text={{ urlencode($baiViet->TieuDe) }}" target="_blank" class="btn btn-outline-info btn-sm">
                        <i class="bi bi-twitter"></i> Twitter
                    </a>
                    <button onclick="copyToClipboard()" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-link-45deg"></i> Copy link
                    </button>
                </div>
            </div>

            {{-- Bài viết liên quan --}}
            <div class="related-posts mt-5 pt-5 border-top">
                <h4 class="mb-4">Bài viết liên quan</h4>
                <div class="row">
                    @forelse($relatedPosts as $related)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($related->HinhAnh && file_exists(public_path($related->HinhAnh)))
                                    <img src="{{ asset($related->HinhAnh) }}" class="card-img-top" alt="{{ $related->TieuDe }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <i class="bi bi-image" style="font-size: 2rem; color: #ddd;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($related->TieuDe, 50) }}</h6>
                                    <p class="card-text text-muted small">{{ $related->NgayTao->format('d/m/Y') }}</p>
                                    <a href="{{ route('blog.show', $related->slug) }}" class="btn btn-sm btn-outline-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">Không có bài viết liên quan</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Nút quay lại --}}
            <div class="mt-5">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại danh sách bài viết
                </a>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-md-4">
            {{-- Tìm kiếm --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Tìm kiếm</h5>
                    <form action="{{ route('blog.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Tìm bài viết...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Bài viết mới nhất --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Bài viết mới nhất</h5>
                    <div class="list-group list-group-flush">
                        @forelse($latestPosts as $latest)
                            <a href="{{ route('blog.show', $latest->slug) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ Str::limit($latest->TieuDe, 35) }}</h6>
                                </div>
                                <small class="text-muted">{{ $latest->NgayTao->format('d/m/Y') }}</small>
                            </a>
                        @empty
                            <p class="text-muted text-center">Chưa có bài viết</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .post-content {
        line-height: 1.8;
        font-size: 1rem;
        color: #333;
    }

    .post-content img {
        max-width: 100%;
        height: auto;
        margin: 20px 0;
        border-radius: 5px;
    }

    .post-content p {
        margin-bottom: 1.2rem;
    }

    .post-content h2,
    .post-content h3,
    .post-content h4 {
        margin-top: 1.5rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .post-meta {
        color: #666;
        font-size: 0.9rem;
    }
</style>

<script>
    function copyToClipboard() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(() => {
            alert('Đã copy link vào clipboard!');
        }).catch(() => {
            alert('Lỗi khi copy link');
        });
    }
</script>
@endsection
