<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ToppingController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\WebController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('client.home');
    Route::get('/menu', [ProductController::class, 'menu'])->name('client.product.menu');
    Route::get('/product/{slug}', [ProductController::class, 'show'])->name('client.product.show');
    Route::post('/product/{slug}', [ProductController::class, 'addToCart'])->name('client.product.add-to-cart');
    Route::get('/cart', [CartController::class, 'index'])->name('client.cart.index');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('client.cart.checkout');
    Route::post('/checkout', [CartController::class, 'postCheckout'])->name('client.cart.post-checkout');
    Route::get('/order', [OrderController::class, 'index'])->name('client.order.index');
    Route::get('/order/{order}/invoice}', [OrderController::class, 'invoice'])->name('client.order.invoice');
    Route::post('/order/{order}/cancel}', [OrderController::class, 'postCancel'])->name('client.order.cancel');
    Route::post('/order/{order}/rate}', [OrderController::class, 'postRate'])->name('client.order.rate');
    Route::get('/profile', [ProfileController::class, 'index'])->name('client.profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('client.profile.update');
    Route::post('/profile', [ProfileController::class, 'postChangePassword'])->name('client.profile.post-change-password');
    Route::get('/profile/membership', [ProfileController::class, 'membership'])->name('client.profile.membership');
    Route::get('/profile/location', [ProfileController::class, 'location'])->name('client.profile.location');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('client.profile.settings');
    Route::get('/profile/promotion', [ProfileController::class, 'promotion'])->name('client.profile.promotion');

    Route::get('/403', function ()  {
        return view('shared.errors.403');
    });
    Route::get('/404', function ()  {
        return view('shared.errors.404');
    });
    Route::get('/500', function ()  {
        return view('shared.errors.500');
    });
    Route::get('/502', function ()  {
        return view('shared.errors.502');
    });
    Route::get('/503', function ()  {
        return view('shared.errors.503');
    });
    Route::get('/504', function ()  {
        return view('shared.errors.504');
    });
});

Route::prefix('/auth')->group(function () {
    Route::get('/google', [GoogleController::class, 'redirect'])->name('auth.google.redirect');
    Route::get('/google/call-back', [GoogleController::class, 'callback'])->name('auth.google.callback');
    Route::get('/login', [WebController::class, 'login'])->name('auth.login');
    Route::get('/register', [WebController::class, 'register'])->name('auth.register');
    Route::get('/forgot-password', [WebController::class, 'forgotPassword'])->name('auth.forgot-password');
    Route::get('/get-otp', [WebController::class, 'getOtp'])->name('auth.get-otp');
    Route::get('/recovery', [WebController::class, 'recovery'])->name('auth.recovery');
    Route::get('/user-info', [WebController::class, 'userInfo'])->name('auth.user-info');

    Route::post('/login', [WebController::class, 'postLogin'])->name('auth.post-login');
    Route::post('/register', [WebController::class, 'postRegister'])->name('auth.post-register');
    Route::post('/forgot-password', [WebController::class, 'postForgotPassword'])->name('auth.post-forgot-password');
    Route::post('/get-otp', [WebController::class, 'postGetOtp'])->name('auth.post-get-otp');
    Route::post('/recovery', [WebController::class, 'postRecovery'])->name('auth.post-recovery');
    Route::post('/user-info', [WebController::class, 'postUserInfo'])->name('auth.post-user-info');
});


Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/addresses', AddressController::class);
    Route::resource('/products', AdminProductController::class);
    Route::resource('/orders', AdminOrderController::class);
    Route::resource('/carts', AdminCartController::class);
    Route::resource('/attributes', AttributeController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/toppings', ToppingController::class);
    Route::resource('/banners', BannerController::class);
    Route::resource('/promotions', PromotionController::class);
    Route::resource('/memberships', MembershipController::class);
    Route::resource('/order-statuses', OrderStatusController::class);
    Route::resource('/payment-methods', PaymentMethodController::class);
    Route::resource('/transactions', TransactionController::class);
    Route::resource('/evaluations', EvaluationController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/pages', AdminPageController::class);
    Route::resource('/logs', LogController::class);
    Route::resource('/messages', MessageController::class);
    Route::resource('/conversations', ConversationController::class);
    Route::resource('/invoices', InvoiceController::class);
});
