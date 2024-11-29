<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthAdmin;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/shop/{product_slug}',[ShopController::class,'product_details'])->name('shop.details');

Route::get('/contact',[HomeController::class,'contact'])->name('home.contact');
Route::post('/contact/store',[HomeController::class,'contact_store'])->name('home.contact-store');

Route::get('/search',[HomeController::class,'search'])->name('home.search');


Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart/add',[CartController::class,'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}',[CartController::class,'increment_cart_quantity'])->name('cart.increase_quantity');
Route::put('/cart/decrease-quantity/{rowId}',[CartController::class,'decrement_cart_quantity'])->name('cart.decrease_quantity');

Route::delete('/cart/remove/{rowId}',[CartController::class,'remove_item'])->name('cart.remove_item');
Route::delete('/cart/clear',[CartController::class,'empty_cart'])->name('cart.empty');

Route::post('/cart/apply-coupon',[CartController::class,'apply_coupon'])->name('cart.apply-coupon');
Route::delete('/cart/remove-coupon',[CartController::class,'remove_coupon'])->name('cart.remove-coupon');

Route::get('/checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::post('/place_order',[CartController::class,'place_an_order'])->name('cart.place-order');
Route::get('/order-confirmation',[CartController::class,'order_confirmation'])->name('cart.order-confirmation');

Route::middleware(['auth'])->group(function(){
    Route::get('/account-dashboard', [UserController::class,'index'])->name('user.index');
    Route::get('/account-orders', [UserController::class,'orders'])->name('user.orders');
    Route::get('/account-order/{order_id}', [UserController::class,'order_details'])->name('user.order-details');
    Route::put('/account-order/cancel-order', [UserController::class,'cancel_order'])->name('user.order-cancel');
});
Route::middleware(['auth',AuthAdmin::class])->group(callback: function(){
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/brands',[AdminController::class,'brands'])->name('admin.brands');
    Route::get('/admin/brand/add',[AdminController::class,'add_brand'])->name('admin.add-brand');
    Route::post('/admin/brand/store',[AdminController::class,'brand_store'])->name('admin.brand-store');
    Route::get('/admin/brand/edit/{id}',[AdminController::class,'brand_edit'])->name('admin.edit-brand');
    Route::put('/admin/brand/update',[AdminController::class,'brand_update'])->name('admin.update-brand');
    Route::delete('/admin/brands/delete/{id}',[AdminController::class,'delete_brand'])->name('admin.delete-brand');


    Route::get('/admin/categories',[AdminController::class,'categories'])->name('admin.categories');
    Route::get('/admin/categories/add',[AdminController::class,'category_add'])->name('admin.add-category');
    Route::post('/admin/categories/store',[AdminController::class,'category_store'])->name('admin.category-store');
    Route::get('/admin/categories/edit/{id}',[AdminController::class,'category_edit'])->name('admin.category-edit');
    Route::put('/admin/categories/update',[AdminController::class,'category_update'])->name('admin.category-update');
    Route::delete('/admin/categories/delete/{id}',[AdminController::class,'category_delete'])->name('admin.category-delete');

    Route::get('/admin/products',[AdminController::class,'products'])->name('admin.products');
    Route::get('/admin/product/add',[AdminController::class,'product_add'])->name('admin.add-product');
    Route::post('/admin/product/store',[AdminController::class,'product_store'])->name('admin.product-store');
    Route::get('/admin/product/edit/{id}',[AdminController::class,'product_edit'])->name('admin.product-edit');
    Route::put('/admin/product/update',[AdminController::class,'product_update'])->name('admin.product-update');
    Route::delete('/admin/product/delete/{id}',[AdminController::class,'product_delete'])->name('admin.product-delete');

    Route::get('/admin/coupons',[AdminController::class,'coupons'])->name('admin.coupons');
    Route::get('/admin/coupon/add',[AdminController::class,'coupon_add'])->name('admin.add-coupon');
    Route::post('/admin/coupon/store',[AdminController::class,'coupon_store'])->name('admin.coupon-store');
    Route::get('/admin/coupon/edit/{id}',[AdminController::class,'coupon_edit'])->name('admin.coupon-edit');
    Route::put('/admin/coupon/update',[AdminController::class,'coupon_update'])->name('admin.coupon-update');
    Route::delete('/admin/coupon/delete/{id}',[AdminController::class,'coupon_delete'])->name('admin.coupon-delete');

    Route::get('/admin/orders',[AdminController::class,'orders'])->name('admin.orders');
    Route::get('/admin/order-details/{order_id}',[AdminController::class,'order_details'])->name('admin.order-details');
    Route::put('/admin/order-update',[AdminController::class,'update_order_status'])->name('admin.update-order');

    Route::get('/admin/slides',[AdminController::class,'slides'])->name('admin.slides');
    Route::get('/admin/slide/add',[AdminController::class,'slide_add'])->name('admin.add-slide');
    Route::post('/admin/slide/store',[AdminController::class,'slide_store'])->name('admin.slide-store');
    Route::get('/admin/slide/edit/{id}',[AdminController::class,'slide_edit'])->name('admin.slide-edit');
    Route::put('/admin/slide/update',[AdminController::class,'slide_update'])->name('admin.slide-update');
    Route::delete('/admin/slide/delete/{id}',[AdminController::class,'slide_delete'])->name('admin.slide-delete');

    Route::get('/admin/contacts',[AdminController::class,'contacts'])->name('admin.contacts');
    Route::delete('/admin/contact/delete/{id}',[AdminController::class,'contact_delete'])->name('admin.contact-delete');

    Route::get('/admin/search',[AdminController::class,'search'])->name('admin.search');
});
