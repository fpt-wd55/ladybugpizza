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
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\ToppingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\WebController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PageController;
use App\Http\Controllers\Client\PoliciesController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\ErrorController;
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
    Route::post('/profile/update', [ProfileController::class, 'postUpdate'])->name('client.profile.post-update');
    Route::post('/profile/change-password', [ProfileController::class, 'postChangePassword'])->name('client.profile.post-change-password');
    Route::post('/profile/inactive', [ProfileController::class, 'postInactive'])->name('client.profile.post-inactive');
    Route::get('/profile/membership', [ProfileController::class, 'membership'])->name('client.profile.membership');
    Route::get('/profile/address', [ProfileController::class, 'address'])->name('client.profile.address');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('client.profile.settings');
    Route::get('/profile/promotion', [ProfileController::class, 'promotion'])->name('client.profile.promotion');
    Route::get('/about-us', [PageController::class, 'aboutUs'])->name('client.about-us');
    Route::get('/policies', [PageController::class, 'policies'])->name('client.policies');
    Route::get('/manual', [PageController::class, 'manual'])->name('client.manual');
    Route::get('/contact', [PageController::class, 'contact'])->name('client.contact');
    Route::post('/contact', [PageController::class, 'postContact'])->name('client.post-contact');
});

Route::prefix('/errors')->group(function () {
    Route::get('/404', [ErrorController::class, 'notFound'])->name('errors.404');
    Route::get('/403', [ErrorController::class, 'forbidden'])->name('errors.403');
    Route::get('/500', [ErrorController::class, 'internalServerError'])->name('errors.500');
    Route::get('/502', [ErrorController::class, 'badGateway'])->name('errors.502');
    Route::get('/503', [ErrorController::class, 'serviceUnavailable'])->name('errors.503');
    Route::get('/504', [ErrorController::class, 'gatewayTimeout'])->name('errors.504');
});

Route::prefix('/auth')->group(function () {
    Route::get('/google', [GoogleController::class, 'redirect'])->name('auth.google.redirect');
    Route::get('/google/call-back', [GoogleController::class, 'callback'])->name('auth.google.callback');
    Route::get('/login', [WebController::class, 'login'])->name('auth.login');
    Route::get('/logout', [WebController::class, 'logout'])->name('auth.logout');
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


Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/users', UserController::class);
    Route::resource('/addresses', AddressController::class);
    Route::resource('/products', AdminProductController::class);
    Route::resource('/orders', AdminOrderController::class);
    Route::resource('/carts', AdminCartController::class);
    Route::resource('/attributes', AttributeController::class);
    Route::resource('/toppings', ToppingController::class);
    Route::resource('/banners', BannerController::class);
    Route::get('/trash-topping', [ToppingController::class, 'trashTopping'])->name('trash-topping');
    Route::get('/restore-topping/{id}', [ToppingController::class, 'resTopping'])->name('resTopping');
    Route::delete('/delete-topping/{id}', [ToppingController::class, 'forceDestroy'])->name('forceDelete-Toppings');
    Route::resource('/categories', CategoryController::class);
    Route::post('/delete-banner/{id}', [BannerController::class, 'trashForce'])->name('trash.bannerDelete');
    Route::post('/restore-banner/{id}', [BannerController::class, 'trashRestore'])->name('trash.bannerRestore');
    Route::get('/trash-banner', [BannerController::class, 'trashList'])->name('trash.listBanner');
    Route::get('/trash-category', [CategoryController::class, 'trashCategory'])->name('trash.listcate');
    Route::post('/restore-category/{id}', [CategoryController::class, 'trashRestore'])->name('trash.cateRestore');
    Route::post('/delete-category/{id}', [CategoryController::class, 'trashForce'])->name('trash.cateDelete');
    Route::resource('/banners', BannerController::class);
    Route::get('/trash-promotions', [BannerController::class, 'trashList'])->name('trash.listBanner');
    Route::resource('/promotions', PromotionController::class);
    Route::resource('/memberships', MembershipController::class);
    Route::resource('/order-statuses', OrderStatusController::class);
    Route::resource('/payment-methods', PaymentMethodController::class);
    Route::resource('/transactions', TransactionController::class);
    Route::resource('/evaluations', EvaluationController::class);
    Route::resource('/shippings', ShippingController::class);
    Route::resource('/pages', AdminPageController::class);
    Route::resource('/logs', LogController::class);
    Route::resource('/messages', MessageController::class);
    Route::resource('/conversations', ConversationController::class);
    Route::get('/components', [DashboardController::class, 'components']);
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
});

// Cai nay dung chung luon
Route::get('/invoices/{slug}', [InvoiceController::class, 'show'])->name('invoices.show');
