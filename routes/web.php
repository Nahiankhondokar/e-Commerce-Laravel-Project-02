<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CMSController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\MainAdminController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Backend\ProductBrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\UserController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\MainUserController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaypalController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// default route
// Route::get('/', function () {
//     return view('welcome');
// });

// category route manage
use App\Models\Category;
$CatsUrl = Category::select('url') -> where('status', 1) -> get() -> pluck('url');
// echo '<pre>'; print_r($CatsUrl); die;

// admin auth route
Route::middleware([
    'auth:sanctum,admin',
    'verified'
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('backend.index');
    })->name('dashboard');
});

// user auth route
Route::middleware([
    'auth:sanctum,web',
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('frontend.index');
    })->name('dashboard');
});


// admin rote
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){

    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store']) -> name('admin.login');

});


/**
 * admin rotues
 * backend
 */
Route::get('/admin/logout', [AdminController::class, "destroy"]) -> name('admin.logout');

Route::group(['prefix'  => 'admin'], function(){

    // admin profile
    Route::get('/profile', [MainAdminController::class, "AdminProfile"]) -> name('admin.profile');
    Route::get('/profile/edit', [MainAdminController::class, "AdminProfileEdit"]) -> name('admin.profile.edit');
    Route::post('/profile/update/{id}', [MainAdminController::class, "AdminProfileUpdate"]) -> name('admin.profile.update');

    Route::get('/password/change', [MainAdminController::class, "PasswordChangeView"]) -> name('admin.pass.view');
    Route::post('/password/update', [MainAdminController::class, "PasswordUpdate"]) -> name('admin.pass.update');


    // admin section routes
    Route::get('/section', [SectionController::class, "SectionView"]) -> name('section.view');
    Route::get('/section/active-inactive', [SectionController::class, "SectionActiveInactive"]);

    

    // Categroy all routes
    Route::get('/category', [CategoryController::class, "CategoryView"]) -> name('category.view');
    Route::get('/category/add', [CategoryController::class, "CategoryAddView"]) -> name('category.add.view');
    Route::get('/category/active-inactive', [CategoryController::class, "CategoryActiveInactive"]);

    Route::get('/get/categroy/section/wise', [CategoryController::class, "GetCategorySectionWise"]);
    Route::post('/categroy/store', [CategoryController::class, "CategoryStore"]) -> name('category.store');

    Route::get('/get/edit/categroy/section/wise', [CategoryController::class, "GetEditCategorySectionWise"]);
    Route::get('/category/edit/{id}', [CategoryController::class, "CategoryEdit"]) -> name('category.edit');

    Route::post('/category/update/{id}', [CategoryController::class, "CategoryUpdate"]) -> name('category.update');
    Route::get('/category/delete/{id}', [CategoryController::class, "CategoryDelete"]) -> name('category.delete');



    // Product all routes
    Route::get('/product', [ProductController::class, "ProductView"]) -> name('product.view');
    Route::get('/product/active-inactive', [ProductController::class, "ProductActiveInactive"]);

    Route::match(['get', 'post'], '/product/add/edit/{id?}', [ProductController::class, "ProductAddOrEdit"]) -> name('product.add.edit');

    Route::get('/product/main_img/video/delete/ajax', [ProductController::class, "ProductImageVideoDeleteAjax"]) -> name('product.add.edit.store');



    // product attribute
    Route::match(['get', 'post'], '/product/attr/add/edit/{id}', [ProductController::class, "ProductAttrViewOrAdd"]) -> name('product.add.edit.attr');
    
    Route::post('/product/attr/update', [ProductController::class, "ProductAttrUpdate"]) -> name('product.attr.update');
    Route::get('/product/attr/active-inactive', [ProductController::class, "ProductAttrActiveInactive"]);

    Route::get('/product/attr/delete/{id}', [ProductController::class, "ProductAttrDelete"]) -> name('product.attr.delete');


    // product gallery
    Route::match(['get', 'post'], '/product/gallery/add/{id}', [ProductController::class, "ProductGalleryAdd"]) -> name('product.gallery.add');
    Route::get('/product/gallery/active-inactive', [ProductController::class, "ProductGalleryActiveInactive"]);

    Route::get('/product/gallery/delete/{id}', [ProductController::class, "ProductGalleryImageDelete"]) -> name('product.gallery.delete');


    // brand all routes
    Route::get('/product/brand', [ProductBrandController::class, "BrandView"]) -> name('brand.view');
    Route::match(['get', 'post'],'/product/brand/add/edit/{id?}', [ProductBrandController::class, "BrandAddEdit"]) -> name('brand.add.edit');

    Route::get('/product/all/brand', [ProductBrandController::class, "GetAllProductBrand"]);
    Route::get('/product/brand/single/edit/{id}', [ProductBrandController::class, "ProductBrandEdit"]);

    Route::get('/product/brand/active-inactive', [ProductBrandController::class, "ProductBrandActiveInactive"]);

    Route::get('/product/brand/delete/{id}', [ProductBrandController::class, "ProductBrandDelete"]);


    // banner all routes
    Route::get('/banner', [BannerController::class, "BannerView"]) -> name('banner.view');
    Route::match(['get', 'post'],'/banner/add/edit/{id?}', [BannerController::class, "BannerAddEdit"]);

    Route::get('/banner/all', [BannerController::class, "GetAllBanner"]);
    Route::get('/banner/single/edit/{id}', [BannerController::class, "BannerEdit"]);

    Route::get('/banner/active-inactive', [BannerController::class, "BannerActiveInactive"]);

    Route::get('/banner/delete/{id}', [BannerController::class, "BannerDelete"]);


    // Coupon all routes
    Route::get('/coupon', [CouponController::class, "CouponView"]) -> name('coupon.view');
    Route::get('/coupon/active-inactive', [CouponController::class, "CouponActiveInactive"]);

    Route::match(['get', 'post'], '/coupon/edit/add/{id?}', [CouponController::class, "CouponAddOrEdit"]) -> name('coupon.edit.add');

    Route::get('/coupon/delete/{id}', [CouponController::class, "CouponDelete"]) -> name('coupon.delete');


    // order all route
    Route::get('/order', [BackendOrderController::class, "OrderViewAdmin"]) -> name('admin.order.view');
    Route::get('/order-details/{id}', [BackendOrderController::class, "OrderDetailsAdmin"]) -> name('admin.order.details');
    Route::post('/order-status', [BackendOrderController::class, "OrderStatusUpdateAdmin"]) -> name('order.status.update');


    // order invoice number
    Route::get('/order-invoice/{id}', [BackendOrderController::class, "OrderInvoiceNumver"]) -> name('order.invoice');

    // order PDF invoice 
    Route::get('/print-pdf-invoice/{id}', [BackendOrderController::class, "OrderPDFInvoice"]) -> name('order.pdf');



    // Shipping Charges routes
    Route::get('/shipping-charge', [ShippingController::class, "ShippingChargeView"]) -> name('shipping.view');
    Route::get('/shipping/edit/{id}', [ShippingController::class, "ShippingChargeEdit"]) -> name('shipping.edit');

    Route::post('/shipping/edit/update/{id}', [ShippingController::class, "ShippingChargeUpdate"]) -> name('shipping.update');
    Route::get('/shippe/active-inactive', [ShippingController::class, "ShippingActiveInactive"]) -> name('shipping.status');


    // all user route
    Route::get('/view', [UserController::class, "getAllUser"]) -> name('user.view');
    Route::get('/user/active-inactive', [UserController::class, "UserActiveInactive"]);


    // all CMS route
    Route::get('/CMS/View', [CMSController::class, "CMSView"]) -> name('cms.view');
    Route::get('/CMS/active-inactive', [CMSController::class, "CMSActiveInactive"]);

});


/**
 * user all routes 
 * frontend
 */
// category wise product get
foreach ($CatsUrl as $url) {
    Route::get('/'.$url, [FrontendProductController::class, "ProductListing"]);
}
Route::get('/', [IndexController::class, "IndexView"]);

// product search
Route::get('/search', [FrontendProductController::class, "ProductListing"]);

// product details page
Route::get('/product/details/{id}', [FrontendProductController::class, "ProductDetailsPage"]) -> name('product.details');
Route::get('/get-price-by-product-size', [FrontendProductController::class, "ProductWiseGetPrice"]);


// cart all routes
Route::post('/add-to-cart', [FrontendProductController::class, "AddToCart"]) -> name('add.to.cart');
Route::get('/cart', [FrontendProductController::class, "CartPage"]) -> name('cart.view');
Route::get('/update/cart-item-qty', [FrontendProductController::class, "CartItemUpdateByAjax"]);
Route::get('/delete-cart-item', [FrontendProductController::class, "CartItemDeleteByAjax"]);


/**
 *  user login & registration routes
 */
Route::get('/login', [MainUserController::class, "LoginRegPageView"]);
Route::post('/login', [MainUserController::class, "LoginUser"]) -> name('login');
Route::post('/user-register', [MainUserController::class, "UserRegister"]) -> name('user.register');
// email check by js validation
Route::match(['get', 'post'],'/check-email', [MainUserController::class, "UserEmailCheck"]);

// user account activate
Route::match(['get', 'post'],'/confirm/{code}', [MainUserController::class, "UserAccountActivate"]) -> name('confirm');

// user forgot password
Route::match(['get', 'post'],'/forgot-password', [MainUserController::class, "UserForgotPassword"]) -> name('forgot.password');

// Postal Code 
Route::get('/postal-code/check', [FrontendProductController::class, "PostalCodeCheck"]);


// user details update routes Auth Middleware
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
    // user insert details
    Route::match(['get', 'post'],'/my-account', [MainUserController::class, "UserInsertDetails"]) -> name('myaccount');

    Route::get('/logout', [MainUserController::class, "Logout"]) -> name('user.logout');
    Route::get('/profile', [MainUserController::class, "UserProfile"]) -> name('user.profile');

    Route::get('/password-check', [MainUserController::class, "PasswordCheck"]);
    // Route::get('/password/change', [MainUserController::class, "PasswordChange"]) -> name('user.password.view');

    Route::post('/password/update', [MainUserController::class, "PasswordUpdate"]) -> name('user.password.update');
    Route::get('/profile/edit/{id}', [MainUserController::class, "UserProfileEdit"]) -> name('user.profile.edit');
    Route::post('/profile/update/{id}', [MainUserController::class, "UserProfileUpdate"]) -> name('user.profile.update');


    // apply coupon route
    Route::post('/coupon-apply', [CouponController::class, "CouponApply"]) -> name('coupon.apply');


    // check-out all routes
    Route::match(['get', 'post'],'/checkout', [FrontendProductController::class, "CheckoutView"]) -> name('checkout');

    // delivery address add or edit routes
    Route::match(['get', 'post'],'/delivery/address/{id?}', [FrontendProductController::class, "DeliveryAddressAddEdit"]) -> name('delivery.address.add.edit');

    Route::get('/delete-delivery-address/{id}', [FrontendProductController::class, "DeliveryAddressDelete"]) -> name('address.delete');


    // thanks page after order 
    Route::get('/thanks', [FrontendProductController::class, "ThanksForOrder"]) -> name('thanks');


    // Orders all routes
    Route::get('/order', [OrderController::class, "OrderView"]) -> name('order.view');
    Route::get('/order-details', [OrderController::class, "OrderDetails"]) -> name('order.details');


    // Paypal payment route
    Route::get('/paypal', [PaypalController::class, "ThanksToPaypal"]) -> 
    name('paypal.thanks');
    Route::get('/paypal/success', [PaypalController::class, "PaypalSuccess"]);
    Route::get('/paypal/fail', [PaypalController::class, "PaypalFail"]);
    Route::post('/paypal/ipn', [PaypalController::class, "PaypalIPN"]);



});


// Route::get('/login', [::class, "LoginRegPageView"]);
// Route::get('/register', [::class, "LoginRegPageView"]);



