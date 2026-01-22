<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\CompanyInfo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Đăng ký các dịch vụ ứng dụng.
     */
    public function register(): void
    {
        //
    }

    /**
     * Khởi động các dịch vụ ứng dụng.
     */
    public function boot(): void
    {
        // Chia sẻ dữ liệu công ty cho tất cả các view
        View::composer('*', function ($view) {
            if (!$view->offsetExists('company')) {
                $company = CompanyInfo::find(1);
                $view->with('company', $company);
            }
        });
    }
}
