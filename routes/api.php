<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Country
    Route::apiResource('countries', 'CountryApiController');

    // City
    Route::post('cities/media', 'CityApiController@storeMedia')->name('cities.storeMedia');
    Route::apiResource('cities', 'CityApiController');

    // Area
    Route::apiResource('areas', 'AreaApiController');

    // Category
    Route::post('categories/media', 'CategoryApiController@storeMedia')->name('categories.storeMedia');
    Route::apiResource('categories', 'CategoryApiController');

    // Feature
    Route::apiResource('features', 'FeatureApiController');

    // Place
    Route::post('places/media', 'PlaceApiController@storeMedia')->name('places.storeMedia');
    Route::apiResource('places', 'PlaceApiController');

    // Item Review
    Route::apiResource('item-reviews', 'ItemReviewApiController');

    // Home Slider
    Route::post('home-sliders/media', 'HomeSliderApiController@storeMedia')->name('home-sliders.storeMedia');
    Route::apiResource('home-sliders', 'HomeSliderApiController');
});
