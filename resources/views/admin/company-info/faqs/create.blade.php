@extends('admin.layouts.app')

@section('title', isset($faq) ? 'Sửa câu hỏi' : 'Tạo câu hỏi')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        {{ isset($faq) ? 'Sửa câu hỏi' : 'Tạo câu hỏi mới' }}
                    </h5>
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

                    <form method="POST" action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}">
                        @csrf
                        @if(isset($faq))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label fw-bold">Câu hỏi</label>
                            <input type="text" name="question" class="form-control"
                                   value="{{ isset($faq) ? $faq->question : '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Câu trả lời</label>
                            <textarea name="answer" class="form-control" rows="6" required>{{ isset($faq) ? $faq->answer : '' }}</textarea>
                            <small class="text-muted">Hỗ trợ HTML tags (ví dụ: &lt;br&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt;)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Thứ tự</label>
                            <input type="number" name="order" class="form-control"
                                   value="{{ isset($faq) ? $faq->order : 0 }}">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-outline-secondary">Quay lại</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> {{ isset($faq) ? 'Cập nhật' : 'Tạo mới' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
