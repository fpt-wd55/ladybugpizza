<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComboController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EvaluationController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CartController as AdminCartController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\MessageController;
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
use App\Models\Evaluation;
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
    Route::post('/product/favorite/{slug}', [ProductController::class, 'postFavorite'])->name('client.product.post-favorite');
    Route::post('/product/cart/{slug}', [ProductController::class, 'addToCart'])->name('client.product.add-to-cart');
    Route::get('/cart', [CartController::class, 'index'])->name('client.cart.index');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('client.cart.checkout');
    Route::post('/checkout', [CartController::class, 'postCheckout'])->name('client.cart.post-checkout');
    Route::get('/order', [OrderController::class, 'index'])->name('client.order.index');
    Route::get('/order/{order}/invoice}', [OrderController::class, 'invoice'])->name('client.order.invoice');
    Route::post('/order/{order}/cancel}', [OrderController::class, 'postCancel'])->name('client.order.cancel');
    Route::post('/order/{order}/rate}', [OrderController::class, 'postRate'])->name('client.order.rate');
    Route::get('/profile', [ProfileController::class, 'index'])->name('client.profile.index');
    Route::put('/profile/update', [ProfileController::class, 'postUpdate'])->name('client.profile.post-update');
    Route::put('/profile/change-password', [ProfileController::class, 'postChangePassword'])->name('client.profile.post-change-password');
    Route::put('/profile/inactive', [ProfileController::class, 'postInactive'])->name('client.profile.post-inactive');
    Route::get('/profile/membership', [ProfileController::class, 'membership'])->name('client.profile.membership');
    Route::get('/profile/membership/history', [ProfileController::class, 'membershipHistory'])->name('client.profile.membership-history');
    Route::get('/profile/address', [ProfileController::class, 'address'])->name('client.profile.address');
    Route::get('/profile/address/add', [ProfileController::class, 'addLocation'])->name('client.profile.add-location');
    Route::post('/profile/address', [ProfileController::class, 'storeLocation'])->name('client.profile.post-location');
    Route::get('/profile/address/edit/{address}', [ProfileController::class, 'editLocation'])->name('client.profile.edit-location');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('client.profile.settings');
    Route::put('/settings/update/{id}', [ProfileController::class, 'updateStatus'])->name('client.settings.update');
    Route::get('/profile/promotion', [ProfileController::class, 'promotion'])->name('client.profile.promotion');
    Route::post('/profile/promotion/{id}', [ProfileController::class, 'redeemPromotion'])->name('client.profile.redeem-promotion');
    Route::get('/about-us', [PageController::class, 'aboutUs'])->name('client.about-us');
    Route::get('/policies', [PageController::class, 'policies'])->name('client.policies');
    Route::get('/manual', [PageController::class, 'manual'])->name('client.manual');
    Route::get('/contact', [PageController::class, 'contact'])->name('client.contact');
    Route::post('/contact', [PageController::class, 'postContact'])->name('client.post-contact');
    Route::get('/favorites', [ProductController::class, 'favorites'])->name('client.product.favorites');
    Route::get('product/{slug}/favorite', [ProductController::class, 'postFavorite'])->name('client.product.post-favorite');
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
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // User
    Route::resource('/users', UserController::class);
    Route::get('/user/export', [UserController::class, 'export'])->name('users.export');
    // Address
    Route::resource('/addresses', AddressController::class);
    // Order
    Route::resource('/orders', AdminOrderController::class);
    Route::get('/order/export', [AdminOrderController::class, 'export'])->name('orders.export');

    Route::resource('/carts', AdminCartController::class);
    // Product
    Route::resource('/products', AdminProductController::class);
    Route::get('/product/export', [AdminProductController::class, 'export'])->name('products.export');
    Route::get('/product/trash', [AdminProductController::class, 'trash'])->name('trash-products');
    Route::post('/product/restore/{id}', [AdminProductController::class, 'restore'])->name('restore-product');
    Route::delete('/product/delete/{id}', [AdminProductController::class, 'forceDelete'])->name('delete-product');
    Route::get('/comment-products/{id}', [AdminProductController::class, 'listComment'])->name('comment-products');
    // Attribute
    Route::resource('/attributes', AttributeController::class);
    Route::get('/attribute/export', [AttributeController::class, 'export'])->name('attributes.export');
    Route::get('/attribute/trash', [AttributeController::class, 'trashAttribute'])->name('trash-attributes');
    Route::post('/attribute/restore/{id}', [AttributeController::class, 'restoreAttribute'])->name('restore-attribute');
    Route::delete('/attribute/delete/{id}', [AttributeController::class, 'deleteAttribute'])->name('delete-attribute');
    // Combo
    Route::resource('/combos', ComboController::class);
    Route::get('/combo/export', [ComboController::class, 'export'])->name('combos.export');
    Route::get('/combo/trash', [ComboController::class, 'trashCombo'])->name('trash-combos');
    Route::post('/combo/restore-/{id}', [ComboController::class, 'restoreCombo'])->name('restore-combo');
    Route::delete('/combo/delete/{id}', [ComboController::class, 'deleteCombo'])->name('delete-combo');
    // Topping
    Route::resource('/toppings', ToppingController::class);
    Route::get('/topping/export', [ToppingController::class, 'export'])->name('toppings.export');
    Route::get('/topping/trash', [ToppingController::class, 'trashTopping'])->name('trash-topping');
    Route::get('/topping/restore/{id}', [ToppingController::class, 'resTopping'])->name('resTopping');
    Route::delete('/topping/delete/{id}', [ToppingController::class, 'forceDestroy'])->name('forceDelete-Toppings');
    // Categories
    Route::resource('/categories', CategoryController::class);
    Route::get('/category/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::get('/category/trash', [CategoryController::class, 'trashCategory'])->name('trash.listcate');
    Route::post('/category/restore/{id}', [CategoryController::class, 'trashRestore'])->name('trash.cateRestore');
    Route::post('/category/delete/{id}', [CategoryController::class, 'trashForce'])->name('trash.cateDelete');
    // Banner
    Route::resource('/banners', BannerController::class);
    Route::get('/banner/trash', [BannerController::class, 'trashList'])->name('trash.listBanner');
    Route::post('/banner/restore/{id}', [BannerController::class, 'trashRestore'])->name('trash.bannerRestore');
    Route::post('/banner/delete/{id}', [BannerController::class, 'trashForce'])->name('trash.bannerDelete');
    // Promotion
    Route::resource('/promotions', PromotionController::class);
    Route::get('/promotion/export', [PromotionController::class, 'export'])->name('promotions.export');
    // Membership
    Route::resource('/memberships', MembershipController::class);
    Route::get('/membership/export', [MembershipController::class, 'export'])->name('memberships.export');
    Route::post('/memberships/{membership}/status', [MembershipController::class, 'updateStatus'])->name('memberships.updateStatus');
    // Đánh Giá
    Route::resource('/evaluations', EvaluationController::class);
    Route::get('/evaluation/export', [EvaluationController::class, 'export'])->name('evaluations.export');
    Route::patch('/evaluations/update-status/{id}', [EvaluationController::class, 'updateStatus'])->name('evaluation.updateStatus');
    Route::resource('/transactions', TransactionController::class);
    Route::resource('/shippings', ShippingController::class);
    Route::resource('/pages', AdminPageController::class);
    Route::resource('/logs', LogController::class);

    // Chat
    Route::resource('/chats', MessageController::class);

    Route::get('/components', [DashboardController::class, 'components']);
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
});

// Share route
Route::get('/invoices/{invoiceNumber}', [InvoiceController::class, 'show'])->name('invoices.show');
