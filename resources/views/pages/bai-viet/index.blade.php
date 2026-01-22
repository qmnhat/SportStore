@extends('layouts.app')
@section('title', 'Blog')
@section('content')
<div class="container py-5">
    {{-- Header --}}
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="mb-3">Blog</h1>
            <p class="text-muted">Khám phá các bài viết, kiến thức và tin tức mới nhất từ SportStore</p>
        </div>
    </div>

    <div class="row">
        {{-- Sidebar --}}
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="text-primary fw-bold mb-3">DANH MỤC</h6>

                    {{-- Danh mục --}}
                    <div class="list-group list-group-flush">
                        <a href="{{ route('blog.index') }}"
                            class="list-group-item list-group-item-action border-0 ps-0 py-2 @if(!request('category')) active @endif">
                            <span class="badge bg-primary me-2">{{ $allPostsCount ?? 0 }}</span>
                            Tất cả bài viết
                        </a>

                        @forelse($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->id]) }}"
                            class="list-group-item list-group-item-action border-0 ps-0 py-2 @if(request('category') == $category->id) active @endif">
                            <span class="badge bg-secondary me-2">{{ $category->posts_count ?? 0 }}</span>
                            {{ $category->TenDanhMuc }}
                        </a>
                        @empty
                        <p class="text-muted small">Chưa có danh mục nào</p>
                        @endforelse
                    </div>

                    {{-- Tìm kiếm --}}
                    <hr>
                    <div class="mt-3">
                        <form action="{{ route('blog.index') }}" method="GET" class="input-group">
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="Tìm kiếm..." value="{{ request('search') }}">
                            <button class="btn btn-primary btn-sm" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="col-lg-9">
            @if($baiViets->count() > 0)
                <div class="row g-4">
                    @foreach($baiViets as $post)
                    <div class="col-md-6">
                        <div class="card blog-card h-100 border-0 shadow-sm" style="transition: all 0.3s ease;">

                            {{-- Hình ảnh --}}
                            @if($post->HinhAnh)
                            <div class="blog-image position-relative overflow-hidden" style="height: 250px;">
                                <img src="{{ asset('storage/' . $post->HinhAnh) }}"
                                    alt="{{ $post->TieuDe }}"
                                    class="card-img-top"
                                    style="height: 100%; object-fit: cover; object-position: center; transition: transform 0.3s;">
                                <div class="position-absolute top-0 start-0 p-2">
                                    @if($post->category)
                                    <span class="badge bg-primary">{{ $post->category->TenDanhMuc }}</span>
                                    @endif
                                </div>
                            </div>
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                <i class="fas fa-image text-muted fa-3x"></i>
                            </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                {{-- Tiêu đề --}}
                                <h5 class="card-title mb-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark">
                                        {{ $post->TieuDe }}
                                    </a>
                                </h5>

                                {{-- Tóm tắt --}}
                                <p class="card-text text-muted small flex-grow-1 mb-3">
                                    {{ \Illuminate\Support\Str::limit($post->TomTat, 100, '...') }}
                                </p>

                                {{-- Meta thông tin --}}
                                <div class="d-flex justify-content-between align-items-center small text-muted border-top pt-2">
                                    <span>
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $post->NgayTao->format('d/m/Y') }}
                                    </span>
                                    <span>
                                        <i class="far fa-eye me-1"></i>
                                        {{ $post->LuotXem ?? 0 }} lượt
                                    </span>
                                </div>

                                {{-- Nút đọc tiếp --}}
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-primary btn-sm mt-3 align-self-start">
                                    Đọc tiếp <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Phân trang --}}
                @if($baiViets->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $baiViets->links() }}
                </div>
                @endif
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    @if(request('search'))
                        Không tìm thấy bài viết nào chứa "<strong>{{ request('search') }}</strong>"
                    @elseif(request('category'))
                        Danh mục này chưa có bài viết nào
                    @else
                        Chưa có bài viết nào
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.blog-image:hover img {
    transform: scale(1.05);
}
</style>
@endsection
