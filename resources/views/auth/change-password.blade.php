@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4">
                            <i class="fa fa-key me-2"></i>Đổi mật khẩu
                        </h4>

                        <form method="POST" action="#">
                            {{-- sau này đổi thành route xử lý đổi mật khẩu --}}

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Nhập lại mật khẩu mới</label>
                                <input type="password" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="/" class="btn btn-outline-secondary">
                                    Hủy
                                </a>

                                <button class="btn btn-primary">
                                    Cập nhật mật khẩu
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
