<?php

namespace App\Providers;

use App\Http\Controllers\Admin\HeaderController as AdminHeaderController;
use App\Http\Controllers\Admin\SidebarController;
use App\Http\Controllers\Client\HeaderController;
use App\Http\Controllers\FooterController;
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
            $view->with(HeaderController::showFavorites());
        });
        // Tự động truyền dữ liệu từ FooterController cho view footer
        View::composer('partials.clients.footer', function ($view) {
            $view->with(FooterController::getFooterData());
        });

        View::composer('partials.admins.sidebar', function ($view) {
            $view->with(SidebarController::getPendingOrders());
        });

        View::composer('partials.admins.header', function ($view) {
            $view->with(AdminHeaderController::getNotifications());
        });
    }
}
