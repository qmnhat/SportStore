@extends('admin.layouts.app')

@section('title', 'Chi tiết liên hệ')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Chi tiết liên hệ #{{ $contact->id }}</h3>
                        <a href="{{ url('/admin/contacts') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-8">
                            <!-- Thông tin liên hệ -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2"><strong>📋 Thông tin khách hàng</strong></h5>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <p><strong>Tên:</strong> {{ $contact->name }}</p>
                                        <p><strong>Email:</strong>
                                            <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Điện thoại:</strong>
                                            <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                        </p>
                                        <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i:s') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Nội dung tin nhắn -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2"><strong>💬 Nội dung tin nhắn</strong></h5>
                                <p><strong>Chủ đề:</strong> {{ $contact->subject }}</p>
                                <div class="bg-light p-3 rounded border mt-3">
                                    <p>{{ $contact->message }}</p>
                                </div>
                            </div>

                            <!-- Action buttons -->
                            <div class="mt-4">
                                <a href="mailto:{{ $contact->email }}" class="btn btn-primary">
                                    <i class="fas fa-envelope"></i> Trả lời qua Email
                                </a>
                                <a href="tel:{{ $contact->phone }}" class="btn btn-success">
                                    <i class="fas fa-phone"></i> Gọi điện
                                </a>
                                <a href="https://zalo.me/{{ $contact->phone }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-comment"></i> Chat Zalo
                                </a>
                            </div>
                        </div>

                        <!-- Sidebar: Trạng thái -->
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="card-title"><strong>⚙️ Trạng thái xử lý</strong></h6>

                                    <form action="{{ url('/admin/contacts/' . $contact->id) }}" method="POST">
                                        @csrf @method('PUT')

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Cập nhật trạng thái:</label>
                                            <select name="status" id="status" class="form-select">
                                                <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>
                                                    ⏳ Chờ xử lý
                                                </option>
                                                <option value="in_progress" {{ $contact->status == 'in_progress' ? 'selected' : '' }}>
                                                    🔄 Đang xử lý
                                                </option>
                                                <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>
                                                    ✅ Đã xử lý
                                                </option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-save"></i> Lưu thay đổi
                                        </button>
                                    </form>

                                    <!-- Delete button -->
                                    <form action="{{ url('/admin/contacts/' . $contact->id) }}" method="POST" class="mt-2">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100"
                                                onclick="return confirm('Xóa liên hệ này?')">
                                            <i class="fas fa-trash"></i> Xóa liên hệ
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
