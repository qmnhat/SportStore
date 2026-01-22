<div class="container-fluid px-5 py-4 d-none d-lg-block">
    <div class="row gx-0 align-items-center text-center">
        <div class="col-md-4 col-lg-3 text-center text-lg-start">
            <div class="d-inline-flex align-items-center">
                <a href="/" class="navbar-brand p-0 d-flex align-items-center gap-2">
                    <img src="{{ asset('img/logo.png') }}" style="height: 45px;" alt="SportStore Logo">
                    <span class="text-primary fw-bold d-none d-sm-inline">SportStore</span>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 text-center">
            <div class="position-relative ps-4">

            </div>
        </div>
        <div class="col-md-4 col-lg-3 text-center text-lg-end">
            <div class="d-inline-flex align-items-center">
                <?php $cart = \App\Helpers\CartHelper::getCartInfo(); ?>
                <a href="{{ route('cart.index') }}" class="position-relative me-4 my-auto">
                    <i class="fa fa-shopping-bag fa-2x"></i>
                    @if ($cart['soLuong'] > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.7rem;">
                            {{ $cart['soLuong'] }}
                        </span>
                        <div class="position-absolute bottom-0 start-100 translate-middle badge rounded-pill bg-info"
                            style="font-size: 0.65rem; width: auto;">
                            {{ $cart['tongTien'] }} ₫
                        </div>
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>
