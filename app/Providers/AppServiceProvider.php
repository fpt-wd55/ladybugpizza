<?php

namespace App\Providers;

use App\Http\Controllers\HeaderController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Sử dụng View Composer để truyền dữ liệu vào header
        View::composer('partials.clients.header', function ($view) {
            $view->with(HeaderController::getHeaderData());
        });
    }
}
