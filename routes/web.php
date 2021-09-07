<?php

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
//====FRONTEND====
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
//Danh muc san pham trang chu
Route::get('/category-detail/{category_id}', 'CategoryProduct@show_category_product');
Route::get('/brand-detail/{brand_id}', 'BrandProduct@show_brand_product');
Route::get('/product-detail/{product_id}', 'ProductController@show_product_detail');
//====BACKEND====
Route::get('/admin', 'AuthController@login_auth');
Route::get('/dashboard', 'AuthController@show_dashboard');
//Category Product
Route::get('/add-category-product', 'CategoryProduct@add_category_product');
Route::get('/edit-category-product/{category_product_id}', 'CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'CategoryProduct@delete_category_product');
Route::get('/all-category-product', 'CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'CategoryProduct@active_category_product');


Route::post('/save-category-product', 'CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'CategoryProduct@update_category_product');

Route::post('/arrange-category','CategoryProduct@arrange_category');

//Brand Product
Route::get('/add-brand-product', 'BrandProduct@add_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'BrandProduct@delete_brand_product');
Route::get('/all-brand-product', 'BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'BrandProduct@active_brand_product');

Route::post('/save-brand-product', 'BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'BrandProduct@update_brand_product');

//Search
Route::post('/autocomplete-ajax', 'HomeController@autocomplete_ajax');
Route::post('/search', 'ProductController@search');
//Comment
Route::post('/load-comment', 'ProductController@load_comment');
Route::post('/send-comment', 'ProductController@send_comment');
Route::post('/allow-comment', 'ProductController@allow_comment');
Route::post('/reply-comment', 'ProductController@reply_comment');
Route::post('/insert-rating', 'ProductController@insert_rating');
Route::get('/comment', 'ProductController@list_comment');

//Product
Route::group(['middleware' => 'auth.roles'], function () {
    Route::get('/add-product', 'ProductController@add_product');
    Route::get('/edit-product/{product_id}', 'ProductController@edit_product');
});
Route::get('/delete-product/{product_id}', 'ProductController@delete_product');
Route::get('/all-product', 'ProductController@all_product');

Route::get('/unactive-product/{product_id}', 'ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'ProductController@active_product');

Route::post('/save-product', 'ProductController@save_product');
Route::post('/update-product/{product_id}', 'ProductController@update_product');

Route::post('/export-csv', 'ProductController@export_csv');
Route::post('/import-csv', 'ProductController@import_csv');

//User
Route::get('users', 'UserController@index')->middleware('auth.roles');
Route::post('/update-users/{admin_id}', 'UserController@update_users')->middleware('auth.roles');
Route::post('assign-roles', 'UserController@assign_roles')->middleware('auth.roles');
Route::get('delete-user-roles/{admin_id}', 'UserController@delete_user_roles')->middleware('auth.roles');
Route::post('store-users', 'UserController@store_users');
Route::get('/edit-users/{user_id}', 'UserController@edit_users')->middleware('auth.roles');
Route::post('assign-roles', 'UserController@assign_roles')->middleware('auth.roles');

Route::get('impersonate/{admin_id}', 'UserController@impersonate');
Route::get('impersonate-destroy', 'UserController@impersonate_destroy');

//Cart
Route::post('/update-cart-quantity', 'CartController@update_cart_quantity');
Route::post('/save-cart', 'CartController@save_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-to-cart/{rowId}', 'CartController@delete_to_cart');

//Coupon
Route::post('/check-coupon', 'CartController@check_coupon');
Route::get('/unset-coupon', 'CouponController@unset_coupon');
Route::get('/insert-coupon', 'CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}', 'CouponController@delete_coupon');
Route::get('/list-coupon', 'CouponController@list_coupon');
Route::post('/insert-coupon-code', 'CouponController@insert_coupon_code');
Route::get('/unactive-coupon-product/{coupon_id}', 'CouponController@unactive_coupon_product');
Route::get('/active-coupon-product/{coupon_id}', 'CouponController@active_coupon_product');
//Checkout
Route::get('/login-checkout', 'CheckoutController@login_checkout');
Route::get('/logout-checkout', 'CheckoutController@logout_checkout');
Route::post('/add-customer', 'CheckoutController@add_customer');
Route::post('/order-place', 'CheckoutController@order_place');
Route::post('/login-customer', 'CheckoutController@login_customer');
Route::get('/checkout', 'CheckoutController@checkout');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/select-delivery-home', 'CheckoutController@select_delivery_home');
Route::post('/calculate-fee', 'CheckoutController@calculate_fee');


//Order
Route::get('/manage-order', 'CheckoutController@manage_order');
Route::get('/view-order/{orderId}', 'CheckoutController@view_order');
Route::get('/delete-order/{order_code}', 'CheckoutController@del_order');
Route::get('/print-order/{checkout_code}', 'CheckoutController@print_order');
Route::post('/update-order/{order_id}', 'CheckoutController@update_order');

//Delivery
Route::get('/delivery', 'DeliveryController@delivery');
Route::post('/select-delivery', 'DeliveryController@select_delivery');
Route::post('/insert-delivery', 'DeliveryController@insert_delivery');
Route::post('/select-feeship', 'DeliveryController@select_feeship');
Route::post('/update-delivery', 'DeliveryController@update_delivery');

//Authentication roles
Route::get('/register-auth', 'AuthController@register_auth');
Route::get('/login-auth', 'AuthController@login_auth');
Route::get('/logout-auth', 'AuthController@logout_auth');

Route::post('/login', 'AuthController@login');
