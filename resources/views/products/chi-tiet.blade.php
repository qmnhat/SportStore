@extends('layouts.app')

@section('content')

    <div class="container py-5">

        {{-- Thong tin san pham --}}
        <div class="row g-4">

            <div class="col-md-5">
                <img src="{{ asset($sanPham->HinhAnhChinh) }}" class="img-fluid rounded">
            </div>

            <div class="col-md-7">

                <h3>{{ $sanPham->TenSP }}</h3>

                <h4 class="text-danger mt-2" id="giaHienThi">
                    {{ number_format($sanPham->GiaMacDinh) }} d
                </h4>

                <p id="tonKho">
                    {{ $sanPham->TongTonKho }} items
                </p>

                {{-- Chon size --}}
                <div class="mb-3">
                    <label class="fw-bold">Kich thuoc:</label><br>

                    @foreach ($bienThes as $bt)
                        <button type="button" class="btn btn-outline-dark size-btn me-1" data-bt="{{ $bt->MaBT }}"
                            data-gia="{{ $bt->Gia }}" data-ton="{{ $bt->TonKho }}">
                            {{ $bt->Size }}
                        </button>
                    @endforeach
                </div>

                {{-- Add cart --}}
                <form action="{{ route('cart.add') }}" method="POST" onsubmit="return beforeAddCart()">
                    @csrf

                    <input type="hidden" name="MaBT" id="maBTInput">
                    <input type="hidden" name="SoLuong" id="soLuongHidden">

                    <div class="input-group mb-3" style="width:140px">
                        <button class="btn btn-outline-secondary" type="button" onclick="qtyDown()">-</button>
                        <input type="text" id="qtyInput" class="form-control text-center" value="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="qtyUp()">+</button>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Them vao gio hang
                    </button>

                    <button type="button" onclick="yeuThich()" class="btn btn-outline-danger ms-2">
                        Yeu thich ❤️
                    </button>
                </form>

                {{-- Thong ke --}}
                <div class="mt-3">
                    Luot xem: <span id="viewCount">{{ $sanPham->LuotXem }}</span> |
                    Yeu thich: <span id="favCount">{{ $sanPham->LuotYeuThich }}</span>
                </div>

            </div>
        </div>

        {{-- Tabs --}}
        <div class="mt-5">

            <div class="nav nav-tabs mb-3">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-desc">
                    Mo ta
                </button>

                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-rev">
                    Danh gia ({{ $soDanhGia }})
                </button>

                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-spec">
                    Thong so
                </button>
            </div>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="tab-desc">
                    {!! $sanPham->MoTa !!}
                </div>

                <div class="tab-pane fade" id="tab-rev">
                    <p>Dang phat trien chuc nang danh gia...</p>
                </div>

                <div class="tab-pane fade" id="tab-spec">
                    {!! $sanPham->ThongSo !!}
                </div>

            </div>

        </div>

        {{-- San pham lien quan --}}
        <div class="mt-5">

            <h4>San pham lien quan</h4>

            <div class="row g-4">

                @if (($related->count() ?? 0) == 0)
                    <p>Khong co san pham lien quan</p>
                @else
                    @foreach ($related as $sp)
                        <div class="col-md-3">
                            <div class="card h-100">

                                <img src="{{ asset($sp->HinhAnhChinh) }}" class="card-img-top">

                                <div class="card-body">
                                    <h6>{{ $sp->TenSP }}</h6>
                                    <p class="text-danger">
                                        {{ number_format($sp->GiaMacDinh) }} d
                                    </p>

                                    <a href="{{ route('sanpham.chitiet', $sp->MaSP) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        Xem
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        function qtyUp() {
            const el = document.getElementById('qtyInput');
            let v = parseInt(el.value || '1');
            el.value = v + 1;
        }

        function qtyDown() {
            const el = document.getElementById('qtyInput');
            let v = parseInt(el.value || '1');
            el.value = Math.max(1, v - 1);
        }

        // Chon size
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.addEventListener('click', () => {

                document.querySelectorAll('.size-btn')
                    .forEach(b => b.classList.remove('active'));

                btn.classList.add('active');

                const maBT = btn.dataset.bt;
                const gia = parseFloat(btn.dataset.gia || 0);
                const ton = parseInt(btn.dataset.ton || 0);

                document.getElementById('maBTInput').value = maBT;
                document.getElementById('giaHienThi').innerText = gia.toLocaleString('vi-VN') + ' d';
                document.getElementById('tonKho').innerText = ton + ' items';
            });
        });

        // Check add cart
        function beforeAddCart() {

            const maBT = document.getElementById('maBTInput').value;

            if (!maBT) {
                alert('Vui long chon kich thuoc (size)');
                return false;
            }

            const qty = parseInt(document.getElementById('qtyInput').value || 1);
            document.getElementById('soLuongHidden').value = Math.max(1, qty);

            return true;
        }

        // Yeu thich
        async function yeuThich() {
            try {
                await fetch(`/api/san-pham/{{ $sanPham->MaSP }}/yeu-thich`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                refreshThongKe();

            } catch (e) {
                console.log(e);
            }
        }

        // Reload thong ke
        async function refreshThongKe() {
            try {
                const res = await fetch(`/api/san-pham/{{ $sanPham->MaSP }}/thong-ke`);
                const data = await res.json();

                document.getElementById('viewCount').innerText = data.luotXem;
                document.getElementById('favCount').innerText = data.luotYeuThich;

            } catch (e) {
                console.log(e);
            }
        }

        // Auto refresh
        setInterval(refreshThongKe, 5000);
    </script>
@endpush
