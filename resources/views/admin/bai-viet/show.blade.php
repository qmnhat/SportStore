@extends('admin.layouts.app')

@section('title', 'Chi tiết Bài Viết')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $baiViet->TieuDe }}</h5>
                    <div>
                        <a href="{{ route('admin.bai-viet.edit', $baiViet->MaBV) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit me-2"></i>Sửa
                        </a>
                        <a href="{{ route('admin.bai-viet.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        {{-- Nội dung chính --}}
                        <div class="col-lg-8">
                            {{-- Hình ảnh --}}
                            @if($baiViet->HinhAnh)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $baiViet->HinhAnh) }}" alt="{{ $baiViet->TieuDe }}"
                                    class="img-fluid border rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>
                            @endif

                            {{-- Tiêu đề --}}
                            <h2 class="mb-2">{{ $baiViet->TieuDe }}</h2>

                            {{-- Meta thông tin --}}
                            <div class="mb-4 pb-3 border-bottom">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ $baiViet->NgayTao?->format('d/m/Y H:i') ?? 'N/A' }}
                                    @if($baiViet->author)
                                    | <i class="fas fa-user me-1"></i>{{ $baiViet->author->name }}
                                    @endif
                                    @if($baiViet->category)
                                    | <i class="fas fa-tag me-1"></i>
                                    <span class="badge bg-info">{{ $baiViet->category->TenDanhMuc }}</span>
                                    @endif
                                    | <i class="fas fa-eye me-1"></i>{{ $baiViet->LuotXem ?? 0 }} lượt xem
                                </small>
                            </div>

                            {{-- Tóm tắt --}}
                            <div class="mb-4">
                                <h5 class="text-secondary">Tóm tắt</h5>
                                <p class="lead">{{ $baiViet->TomTat }}</p>
                            </div>

                            {{-- Nội dung --}}
                            <div class="mb-4">
                                <h5 class="text-secondary">Nội dung</h5>
                                <div class="blog-content" style="line-height: 1.8;">
                                    {!! nl2br(e($baiViet->NoiDung)) !!}
                                </div>
                            </div>
                        </div>

                        {{-- Sidebar --}}
                        <div class="col-lg-4">
                            {{-- Thông tin bài viết --}}
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Thông tin bài viết</h6>
                                </div>
                                <div class="card-body">
                                    <dl class="row">
                                        <dt class="col-sm-6">ID:</dt>
                                        <dd class="col-sm-6">{{ $baiViet->MaBV }}</dd>

                                        <dt class="col-sm-6">Slug:</dt>
                                        <dd class="col-sm-6">
                                            <code>{{ $baiViet->slug }}</code>
                                        </dd>

                                        <dt class="col-sm-6">Danh mục:</dt>
                                        <dd class="col-sm-6">
                                            @if($baiViet->category)
                                            <span class="badge bg-info">{{ $baiViet->category->TenDanhMuc }}</span>
                                            @else
                                            <span class="text-muted">Không có</span>
                                            @endif
                                        </dd>

                                        <dt class="col-sm-6">Trạng thái:</dt>
                                        <dd class="col-sm-6">
                                            @if($baiViet->TrangThai == 1)
                                            <span class="badge bg-success">Công khai</span>
                                            @else
                                            <span class="badge bg-warning">Nháp</span>
                                            @endif
                                        </dd>

                                        <dt class="col-sm-6">Lượt xem:</dt>
                                        <dd class="col-sm-6">{{ $baiViet->LuotXem ?? 0 }}</dd>

                                        <dt class="col-sm-6">Ngày tạo:</dt>
                                        <dd class="col-sm-6">{{ $baiViet->NgayTao?->format('d/m/Y H:i') ?? 'N/A' }}</dd>

                                        <dt class="col-sm-6">Ngày cập nhật:</dt>
                                        <dd class="col-sm-6">{{ $baiViet->NgayCapNhat?->format('d/m/Y H:i') ?? 'N/A' }}</dd>

                                        @if($baiViet->deleted_at)
                                        <dt class="col-sm-6">Xóa lúc:</dt>
                                        <dd class="col-sm-6">{{ $baiViet->deleted_at->format('d/m/Y H:i') }}</dd>
                                        @endif
                                    </dl>
                                </div>
                            </div>

                            {{-- Hành động --}}
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Hành động</h6>
                                </div>
                                <div class="card-body d-grid gap-2">
                                    <a href="{{ route('admin.bai-viet.edit', $baiViet->MaBV) }}" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Sửa bài viết
                                    </a>
                                    <a href="{{ url('/blog/' . $baiViet->slug) }}" class="btn btn-info" target="_blank">
                                        <i class="fas fa-external-link-alt me-2"></i>Xem trên website
                                    </a>
                                    <form action="{{ route('admin.bai-viet.destroy', $baiViet->MaBV) }}" method="POST"
                                        onsubmit="return confirm('Bạn chắc chắn muốn xóa bài viết này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">
                                            <i class="fas fa-trash me-2"></i>Xóa bài viết
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
