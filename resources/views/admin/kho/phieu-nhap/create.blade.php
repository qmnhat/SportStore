@extends('admin.layouts.app')

@section('title', 'Tạo phiếu nhập kho')

@section('content')
<div class="page-heading mb-4">
    <h3>Tạo phiếu nhập kho mới</h3>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kho.phieu-nhap.store') }}" method="POST" id="formPhieuNhap">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nhà cung cấp <span class="text-danger">*</span></label>
                    <select name="MaNCC" class="form-select" required>
                        <option value="">-- Chọn nhà cung cấp --</option>
                        @foreach($nhaCungCaps as $ncc)
                            <option value="{{ $ncc->MaNCC }}" {{ old('MaNCC') == $ncc->MaNCC ? 'selected' : '' }}>
                                {{ $ncc->TenNCC }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Ghi chú</label>
                    <input type="text" name="GhiChu" class="form-control" value="{{ old('GhiChu') }}" placeholder="Ghi chú (nếu có)">
                </div>
            </div>

            <hr>
            <h5>Chi tiết sản phẩm nhập</h5>

            <div id="chiTietContainer">
                {{-- Dòng mẫu --}}
                <div class="row mb-2 chitiet-row">
                    <div class="col-md-5">
                        <select name="chitiet[0][MaBT]" class="form-select select-bienthe" required>
                            <option value="">-- Chọn sản phẩm + size --</option>
                            @foreach($sanPhams as $sp)
                                @foreach($sp->bienThe as $bt)
                                    <option value="{{ $bt->MaBT }}" data-gia="{{ $bt->GiaGoc }}">
                                        {{ $sp->TenSP }} - Size {{ $bt->kichThuoc->TenKT ?? 'N/A' }} (Tồn: {{ $bt->SoLuong }})
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="chitiet[0][SoLuong]" class="form-control" placeholder="Số lượng" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="chitiet[0][GiaNhap]" class="form-control input-gianhap" placeholder="Giá nhập" min="0" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-remove-row">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary mb-3" id="btnAddRow">
                <i class="bi bi-plus-circle"></i> Thêm dòng
            </button>

            <hr>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.kho.phieu-nhap.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Tạo phiếu nhập
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let rowIndex = 1;

document.getElementById('btnAddRow').addEventListener('click', function() {
    const container = document.getElementById('chiTietContainer');
    const firstRow = container.querySelector('.chitiet-row');
    const newRow = firstRow.cloneNode(true);

    // Cập nhật name attributes
    newRow.querySelectorAll('select, input').forEach(el => {
        if (el.name) {
            el.name = el.name.replace(/\[\d+\]/, '[' + rowIndex + ']');
        }
        el.value = '';
    });

    container.appendChild(newRow);
    rowIndex++;
});

document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-remove-row')) {
        const rows = document.querySelectorAll('.chitiet-row');
        if (rows.length > 1) {
            e.target.closest('.chitiet-row').remove();
        } else {
            alert('Phải có ít nhất 1 dòng sản phẩm!');
        }
    }
});

// Auto fill giá nhập từ giá gốc
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('select-bienthe')) {
        const selectedOption = e.target.options[e.target.selectedIndex];
        const gia = selectedOption.dataset.gia || 0;
        const row = e.target.closest('.chitiet-row');
        const giaInput = row.querySelector('.input-gianhap');
        if (giaInput && !giaInput.value) {
            giaInput.value = gia;
        }
    }
});
</script>
@endpush
@endsection
