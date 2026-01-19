<div class="container-fluid px-5 py-4 d-none d-lg-block">
    <div class="row gx-0 align-items-center text-center">
        <div class="col-md-4 col-lg-3 text-center text-lg-start">
            <div class="d-inline-flex align-items-center">
                <a href="" class="navbar-brand p-0">
                    <h1 class="display-5 text-primary m-0"><i
                            class="fas fa-shopping-bag text-secondary me-2"></i>SportStore
                    </h1>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-lg-6 text-center">
            <div class="position-relative ps-4">
                <div class="d-flex border rounded-pill">
                    <input class="form-control border-0 rounded-pill w-100 py-3" type="text"
                        placeholder="Search Looking For?">
                    <select class="form-select text-dark border-0 border-start rounded-0 p-3" style="width: 200px;">
                        <option value="All Category">Danh mục</option>
                        <option value="Pest Control-2">Category 1</option>
                    </select>
                    <button type="button" class="btn btn-primary rounded-pill py-3 px-5" style="border: 0;"><i
                            class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-3 text-center text-lg-end">
            <div class="d-inline-flex align-items-center">
                <?php $cart = \App\Helpers\CartHelper::getCartInfo(); ?>
                <a href="{{ route('cart.index') }}" class="position-relative me-4 my-auto">
                    <i class="fa fa-shopping-bag fa-2x"></i>
                    @if($cart['soLuong'] > 0)
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
