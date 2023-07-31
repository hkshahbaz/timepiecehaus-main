<?php
header("Access-Control-Allow-Origin: *");
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/**<!-- user -->*/
Route::post('login', 'Api\UserController@login');
Route::post('signup', 'Api\UserController@register');

Route::get('email/resend', 'Api\VerificationApiController@resend')->name('verificationapi.resend');

Route::get('email/verify/{id}', 'Api\VerificationApiController@verify')->name('verificationapi.verify');


/**<!-- user -->*/

/**<!-- product -->*/

Route::get('allProduct', 'Api\ProductController@allProduct');
Route::get('getAllHome', 'Api\ProductController@getAllHome');
Route::get('getAllBecomeVendor', 'Api\ProductController@getAllBecomeVendor');
Route::get('getProductDetail/{id}', 'Api\ProductController@getProductDetail');
Route::get('productSearchByName', 'Api\ProductController@productSearchByName');
Route::get('productSearchByKey', 'Api\ProductController@productSearchByKey');
Route::get('getUserProduct/{id}', 'Api\ProductController@getUserProduct');
Route::get('getSingleProductWithAllRating/{id}', 'Api\RatingController@getSingleProductWithAllRating');
/**<!-- product -->*/

/**<!-- brand -->*/
Route::get('getSingleBrandWithAllProduct/{id}', 'Api\BrandController@getSingleBrandWithAllProduct');
Route::get('getAllBrandWithProductCount', 'Api\BrandController@getAllBrandWithProductCount');
/**<!-- brand -->*/

/**<!-- category -->*/
Route::get('getSingleCategoryWithAllProduct/{id}', 'Api\CategoryController@getSingleCategoryWithAllProduct');
Route::get('getAllCategoryWithProductCount', 'Api\CategoryController@getAllCategoryWithProductCount');
/**<!-- category -->*/

/**<!-- country -->*/
Route::get('getAllCountries', 'Api\CheckoutController@getAllCountries');
/**<!-- country -->*/



Route::post('uploadFile/{product}', 'Api\ProductController@uploadFile');
Route::post('removeFile', 'Api\ProductController@removeFile');
Route::post('updatePaypal/{id}', 'Api\CheckoutController@updatePaypal');



//login

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('storeAddStep1', 'Api\ProductController@storeAddStep1');
    Route::post('submitOrder/{product}', 'Api\CheckoutController@submitOrder');
    Route::post('updateStep1/{id}', 'Api\ProductController@updateStep1');
     Route::get('myWatch', 'Api\ProductController@myWatch');
     Route::post('deleteMyWatch/{id}', 'Api\ProductController@deleteMyWatch');
    Route::post('logout', 'Api\UserController@logout');
    Route::post('userPictureUpdate', 'Api\UserController@userPictureUpdate');
    Route::post('userUpdate', 'Api\UserController@userUpdate');
    Route::get('getCurrentUser', 'Api\UserController@getCurrentUser');
    Route::get('getAllWishLists', 'Api\WishListController@getAllWishLists');
    Route::post('addProductRating', 'Api\RatingController@addProductRating');
    Route::post('addWishList', 'Api\WishListController@addWishList');
    Route::post('wishListDelete/{product}', 'Api\WishListController@wishListDelete');
    Route::get('wishListSearchByProductName', 'Api\WishListController@wishListSearchByProductName');
    /**<!-- Product for checkout -->*/
Route::get('getProductForCheckout/{id}', 'Api\CheckoutController@getProductForCheckout');
/**<!-- product for checkout -->*/
});
