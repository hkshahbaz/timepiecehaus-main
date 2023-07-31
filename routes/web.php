<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(['verify' => true]);
Auth::routes();

Route::get('refreshcaptcha', 'Auth\RegisterController@refreshCaptcha');

Route::group(['middleware' => ['verified', 'role:vendor']], function () {
    Route::resource('wishList', 'WishListController', ['parameters' => ['wishLists' => 'wishList']]);

    Route::post('wishList/{product}/delete', 'WishListController@delete')->name('wishList.delete');
    Route::post('wishList/{product}/update', 'WishListController@updateWishList')->name('wishList.update');

    Route::resource('ratings', 'ProductRatingController', ['parameters' => ['ratings' => 'rating']]);

    /* User Routes */
    Route::get('my-account', 'UserController@myAccount')->name('my-account');
    Route::get('my-order', 'UserController@myOrders')->name('my-order');
    Route::post('update-profile', 'UserController@updateProfile')->name('update-profile');
    Route::post('update-subscriptions', 'UserController@updateSubscriptions')->name('update-subscriptions');
    Route::get('sell-watch/{product?}', 'ShopController@sell')->name('sell-watch');
    Route::post('store-ad', 'ShopController@storeAdStep1')->name('store-ad');
    Route::post('shop-update-profile', 'ShopController@updateProfile')->name('shop-update-profile');
    Route::post('upload-file/{product}', 'ShopController@uploadFile')->name('upload-file');
    Route::post('remove-file', 'ShopController@removeFile')->name('remove-file');
    Route::post('set-ad-completed/{product}', 'ShopController@setAdCompleted')->name('set-ad-completed');
    Route::post('report-product', 'ShopController@reportProduct')->name('report-product');

    //Delete Pending Ad'
    Route::post('delete-pending-ad/{product}', 'ShopController@deletePendingAd')->name('delete-pending-ad');

    Route::get('checkout/{product}', 'CheckoutController@index')->name('checkout.index');
    Route::post('submit-order/{product}', 'CheckoutController@submitOrder')->name('submit-order');
    Route::post('update-status/{order}', 'CheckoutController@updateStatus')->name('update-status');
    Route::post('get-order-detail/{id}', 'CheckoutController@getOrderDetail')->name('get-order-detail');
    Route::post('import-watch', 'ShopController@importWatch')->name('import-watch');
    Route::get('download-sample-file', 'ShopController@downloadSampleFile')->name('download-sample-file');

});

Route::get('/', 'HomeController@index');
Route::get('shop', 'ShopController@index')->name('shop.index');

Route::get('watch/{product}', 'ShopController@productDetail')->name('shop.product.detail');

Route::get('about-us', 'PagesController@aboutUs')->name('about-us');
Route::get('contact-us', 'PagesController@contactUs')->name('contact-us');
Route::get('privacy-policy', 'PagesController@privacyPolicy')->name('privacy-policy');
Route::get('faq', 'PagesController@faq')->name('faq');
Route::post('send-email', 'PagesController@sendEmail')->name('send-email');
