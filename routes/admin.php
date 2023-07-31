<?php


use Illuminate\Support\Facades\Route;

Route::get('/admin-login', function () {
    if(auth()->check())
        return redirect('/dashboard');
    return view('admin.auth.login');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');

    /* UserController */
    Route::resource('users', 'Admin\UserController');
    Route::post('users/restore/{id}', 'Admin\UserController@restore')->name('users.restore');
    Route::delete('users/permanentDelete/{id}', 'Admin\UserController@permanentDelete')->name('users.permanent.delete');
    Route::get('getUser/{id}', 'Admin\UserController@getUser')->name('user.get');

    /* StatusController */
    Route::resource('statuses', 'Admin\StatusController')->except(['create', 'show']);
    Route::post('statuses/restore/{id}', 'Admin\StatusController@restore')->name('statuses.restore');
    Route::delete('statuses/permanentDelete/{id}', 'Admin\StatusController@permanentDelete')->name('statuses.permanent.delete');

    /* BrandController */
    Route::resource('brands', 'Admin\BrandController')->except(['create', 'show']);
    Route::post('brands/restore/{id}', 'Admin\BrandController@restore')->name('brands.restore');
    Route::delete('brands/permanentDelete/{id}', 'Admin\BrandController@permanentDelete')->name('brands.permanent.delete');

    /* ConditionController */
    Route::resource('conditions', 'Admin\ConditionController')->except(['create', 'show']);
    Route::post('conditions/restore/{id}', 'Admin\ConditionController@restore')->name('conditions.restore');
    Route::delete('conditions/permanentDelete/{id}', 'Admin\ConditionController@permanentDelete')->name('conditions.permanent.delete');

    /* MovementController */
    Route::resource('movements', 'Admin\MovementController')->except(['create', 'show']);
    Route::post('movements/restore/{id}', 'Admin\MovementController@restore')->name('brands.restore');
    Route::delete('movements/permanentDelete/{id}', 'Admin\MovementController@permanentDelete')->name('brands.permanent.delete');

    /* ColorController */
//    Route::resource('colors', 'Admin\ColorController')->except(['create', 'show']);
//    Route::post('colors/restore/{id}', 'Admin\ColorController@restore')->name('colors.restore');
//    Route::delete('colors/permanentDelete/{id}', 'Admin\ColorController@permanentDelete')->name('colors.permanent.delete');

    /* DialController */
    Route::resource('dials', 'Admin\DialController')->except(['create', 'show']);
    Route::post('dials/restore/{id}', 'Admin\DialController@restore')->name('dials.restore');
    Route::delete('dials/permanentDelete/{id}', 'Admin\DialController@permanentDelete')->name('dials.permanent.delete');

    /* GlassTypeController */
    Route::resource('glassTypes', 'Admin\GlassTypeController')->except(['create', 'show']);
    Route::post('glassTypes/restore/{id}', 'Admin\GlassTypeController@restore')->name('glassTypes.restore');
    Route::delete('glassTypes/permanentDelete/{id}', 'Admin\GlassTypeController@permanentDelete')->name('glassTypes.permanent.delete');

    /* ProductTypeController */
    Route::resource('productTypes', 'Admin\ProductTypeController')->except(['create', 'show']);
    Route::post('productTypes/restore/{id}', 'Admin\ProductTypeController@restore')->name('productTypes.restore');
    Route::delete('productTypes/permanentDelete/{id}', 'Admin\ProductTypeController@permanentDelete')->name('productTypes.permanent.delete');

    /* DialNumeralController */
    Route::resource('dialNumerals', 'Admin\DialNumeralController')->except(['create', 'show']);
    Route::post('dialNumerals/restore/{id}', 'Admin\DialNumeralController@restore')->name('dialNumerals.restore');
    Route::delete('dialNumerals/permanentDelete/{id}', 'Admin\DialNumeralController@permanentDelete')->name('dialNumerals.permanent.delete');

    /* ProductFunctionController */
    Route::resource('productFunctions', 'Admin\ProductFunctionController')->except(['create', 'show']);
    Route::post('productFunctions/restore/{id}', 'Admin\ProductFunctionController@restore')->name('productFunctions.restore');
    Route::delete('productFunctions/permanentDelete/{id}', 'Admin\ProductFunctionController@permanentDelete')->name('productFunctions.permanent.delete');

    /* ClaspTypeController */
    Route::resource('claspTypes', 'Admin\ClaspTypeController')->except(['create', 'show']);
    Route::post('claspTypes/restore/{id}', 'Admin\ClaspTypeController@restore')->name('claspTypes.restore');
    Route::delete('claspTypes/permanentDelete/{id}', 'Admin\ClaspTypeController@permanentDelete')->name('claspTypes.permanent.delete');

    /* WaterResistanceController */
    Route::resource('waterResistances', 'Admin\WaterResistanceController')->except(['create', 'show']);
    Route::post('waterResistances/restore/{id}', 'Admin\WaterResistanceController@restore')->name('waterResistances.restore');
    Route::delete('waterResistances/permanentDelete/{id}', 'Admin\WaterResistanceController@permanentDelete')->name('waterResistances.permanent.delete');

    /* DeliveryScopeController */
    Route::resource('deliveryScopes', 'Admin\DeliveryScopeController')->except(['create', 'show']);
    Route::post('deliveryScopes/restore/{id}', 'Admin\DeliveryScopeController@restore')->name('deliveryScopes.restore');
    Route::delete('deliveryScopes/permanentDelete/{id}', 'Admin\DeliveryScopeController@permanentDelete')->name('deliveryScopes.permanent.delete');

    /* CountryController */
    Route::resource('countries', 'Admin\CountryController')->except(['create', 'show']);
    Route::post('countries/restore/{id}', 'Admin\CountryController@restore')->name('countries.restore');
    Route::delete('countries/permanentDelete/{id}', 'Admin\CountryController@permanentDelete')->name('countries.permanent.delete');

    /* BezelMaterialController */
    Route::resource('bezelMaterials', 'Admin\BezelMaterialController')->except(['create', 'show']);
    Route::post('bezelMaterials/restore/{id}', 'Admin\BezelMaterialController@restore')->name('bezelMaterials.restore');
    Route::delete('bezelMaterials/permanentDelete/{id}', 'Admin\BezelMaterialController@permanentDelete')->name('bezelMaterials.permanent.delete');

    /* CaseMaterialController */
    Route::resource('caseMaterials', 'Admin\CaseMaterialController')->except(['create', 'show']);
    Route::post('caseMaterials/restore/{id}', 'Admin\CaseMaterialController@restore')->name('caseMaterials.restore');
    Route::delete('caseMaterials/permanentDelete/{id}', 'Admin\CaseMaterialController@permanentDelete')->name('caseMaterials.permanent.delete');

    /* BraceletColorController */
    Route::resource('braceletColors', 'Admin\BraceletColorController')->except(['create', 'show']);
    Route::post('braceletColors/restore/{id}', 'Admin\BraceletColorController@restore')->name('braceletColors.restore');
    Route::delete('braceletColors/permanentDelete/{id}', 'Admin\BraceletColorController@permanentDelete')->name('braceletColors.permanent.delete');

    /* DialFeatureController */
    Route::resource('dialFeatures', 'Admin\DialFeatureController')->except(['create', 'show']);
    Route::post('dialFeatures/restore/{id}', 'Admin\DialFeatureController@restore')->name('dialFeatures.restore');
    Route::delete('dialFeatures/permanentDelete/{id}', 'Admin\DialFeatureController@permanentDelete')->name('dialFeatures.permanent.delete');

    /* HandDetailController */
    Route::resource('handDetails', 'Admin\HandDetailController')->except(['create', 'show']);
    Route::post('handDetails/restore/{id}', 'Admin\HandDetailController@restore')->name('handDetails.restore');
    Route::delete('handDetails/permanentDelete/{id}', 'Admin\HandDetailController@permanentDelete')->name('handDetails.permanent.delete');

    /* ClaspMaterialController */
    Route::resource('claspMaterials', 'Admin\ClaspMaterialController')->except(['create', 'show']);
    Route::post('claspMaterials/restore/{id}', 'Admin\ClaspMaterialController@restore')->name('claspMaterials.restore');
    Route::delete('claspMaterials/permanentDelete/{id}', 'Admin\ClaspMaterialController@permanentDelete')->name('claspMaterials.permanent.delete');

    /* MoreSettingController */
    Route::resource('moreSettings', 'Admin\MoreSettingController')->except(['create', 'show']);
    Route::post('moreSettings/restore/{id}', 'Admin\MoreSettingController@restore')->name('moreSettings.restore');
    Route::delete('moreSettings/permanentDelete/{id}', 'Admin\MoreSettingController@permanentDelete')->name('moreSettings.permanent.delete');

    /* ProductCategoryController */
    Route::resource('productCategories', 'Admin\ProductCategoryController')->except(['create', 'show']);
    Route::post('productCategories/restore/{id}', 'Admin\ProductCategoryController@restore')->name('productCategories.restore');
    Route::delete('productCategories/permanentDelete/{id}', 'Admin\ProductCategoryController@permanentDelete')->name('productCategories.permanent.delete');

    /* TimezoneController */
    Route::resource('timezones', 'Admin\TimezoneController')->except(['create', 'show']);
    Route::post('timezones/restore/{id}', 'Admin\TimezoneController@restore')->name('timezones.restore');
    Route::delete('timezones/permanentDelete/{id}', 'Admin\TimezoneController@permanentDelete')->name('timezones.permanent.delete');

    /* LanguageController */
    Route::resource('languages', 'Admin\LanguageController')->except(['create', 'show']);
    Route::post('languages/restore/{id}', 'Admin\LanguageController@restore')->name('languages.restore');
    Route::delete('languages/permanentDelete/{id}', 'Admin\LanguageController@permanentDelete')->name('languages.permanent.delete');

    /*   BraceletMaterialController  */
    Route::resource('braceletMaterials', 'Admin\BraceletMaterialController')->except(['create', 'show']);
    Route::post('braceletMaterials/restore/{id}', 'Admin\BraceletMaterialController@restore')->name('braceletMaterials.restore');
    Route::delete('braceletMaterials/permanentDelete/{id}', 'Admin\BraceletMaterialController@permanentDelete')->name('braceletMaterials.permanent.delete');

    /* ProductController */
    Route::resource('products', 'Admin\ProductController')->except(['create']);
    Route::post('products/update/status/{product}', 'Admin\ProductController@updateStatus')->name('products.update.status');
//    Route::post('products/restore/{id}', 'Admin\ProductController@restore')->name('products.restore');
//    Route::delete('products/permanentDelete/{id}', 'Admin\ProductController@permanentDelete')->name('products.permanent.delete');

    /* ProductController */
    Route::resource('orders', 'Admin\OrderController')->except(['create', 'show', 'destroy', 'update']);

    Route::resource('settings', 'Admin\SettingController')->except(['create', 'show']);

    /*   SuspiciousReportController  */
    Route::resource('suspiciousReport', 'Admin\SuspiciousReportController')->except(['create', 'show']);
    Route::post('suspiciousReport/restore/{id}', 'Admin\SuspiciousReportController@restore')->name('suspiciousReport.restore');
    Route::delete('suspiciousReport/permanentDelete/{id}', 'Admin\SuspiciousReportController@permanentDelete')->name('suspiciousReport.permanent.delete');
    Route::post('suspiciousReport/respondBack/{suspiciousReport}', 'Admin\SuspiciousReportController@respondBack')->name('suspiciousReport.respond.back');
});
