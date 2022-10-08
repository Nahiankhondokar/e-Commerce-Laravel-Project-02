<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\MainAdminController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SectionController;
use App\Http\Controllers\Frontend\MainUserController;
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
Route::get('/', function () {
    return view('welcome');
});


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


// user rotues
Route::group(['prefix' => 'user'], function(){
    Route::get('/logout', [MainUserController::class, "Logout"]) -> name('user.logout');
    Route::get('/profile', [MainUserController::class, "UserProfile"]) -> name('user.profile');
    Route::get('/password/change', [MainUserController::class, "PasswordChange"]) -> name('user.password.view');
    Route::post('/password/update', [MainUserController::class, "PasswordUpdate"]) -> name('user.password.update');
    Route::get('/profile/edit/{id}', [MainUserController::class, "UserProfileEdit"]) -> name('user.profile.edit');
    Route::post('/profile/update/{id}', [MainUserController::class, "UserProfileUpdate"]) -> name('user.profile.update');
});


// admin rotues
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

});

