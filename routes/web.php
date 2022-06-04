<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Country
    Route::delete('countries/destroy', 'CountryController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountryController');

    // City
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::post('cities/media', 'CityController@storeMedia')->name('cities.storeMedia');
    Route::post('cities/ckmedia', 'CityController@storeCKEditorImages')->name('cities.storeCKEditorImages');
    Route::resource('cities', 'CityController');

    // Area
    Route::delete('areas/destroy', 'AreaController@massDestroy')->name('areas.massDestroy');
    Route::resource('areas', 'AreaController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    Route::resource('categories', 'CategoryController');

    // Feature
    Route::delete('features/destroy', 'FeatureController@massDestroy')->name('features.massDestroy');
    Route::resource('features', 'FeatureController');

    // Place
    Route::delete('places/destroy', 'PlaceController@massDestroy')->name('places.massDestroy');
    Route::post('places/media', 'PlaceController@storeMedia')->name('places.storeMedia');
    Route::post('places/ckmedia', 'PlaceController@storeCKEditorImages')->name('places.storeCKEditorImages');
    Route::resource('places', 'PlaceController');

    // Item Review
    Route::delete('item-reviews/destroy', 'ItemReviewController@massDestroy')->name('item-reviews.massDestroy');
    Route::resource('item-reviews', 'ItemReviewController');

    // Home Slider
    Route::delete('home-sliders/destroy', 'HomeSliderController@massDestroy')->name('home-sliders.massDestroy');
    Route::post('home-sliders/media', 'HomeSliderController@storeMedia')->name('home-sliders.storeMedia');
    Route::post('home-sliders/ckmedia', 'HomeSliderController@storeCKEditorImages')->name('home-sliders.storeCKEditorImages');
    Route::resource('home-sliders', 'HomeSliderController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
