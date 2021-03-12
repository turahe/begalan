<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');

Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

Route::group(['prefix' => 'media_manager'], function () {
    Route::get('/', [\App\Http\Controllers\MediaController::class, 'mediaManager'])->name('media_manager');
    Route::post('media-update', [\App\Http\Controllers\MediaController::class, 'mediaManagerUpdate'])->name('media_update');
});

Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\AdminController::class, 'adminCourses'])->name('admin_courses');
    Route::get('popular', [\App\Http\Controllers\Admin\AdminController::class, 'popularCourses'])->name('admin_popular_courses');
    Route::get('featured', [\App\Http\Controllers\Admin\AdminController::class, 'featureCourses'])->name('admin_featured_courses');
});

Route::group(['prefix' => 'settings'], function () {
    Route::get('theme-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'ThemeSettings'])->name('theme_settings');
    Route::get('invoice-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'invoiceSettings'])->name('invoice_settings');
    Route::get('general', [\App\Http\Controllers\Admin\SettingsController::class, 'GeneralSettings'])->name('general_settings');
    Route::get('lms-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'LMSSettings'])->name('lms_settings');

    Route::get('social', [\App\Http\Controllers\Admin\SettingsController::class, 'SocialSettings'])->name('social_settings');
    //Save settings / options
    Route::post('save-settings', [\App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('save_settings');
    Route::get('payment', [\App\Http\Controllers\PaymentController::class, 'PaymentSettings'])->name('payment_settings');
    Route::get('storage', [\App\Http\Controllers\Admin\SettingsController::class, 'StorageSettings'])->name('storage_settings');
});

Route::get('gateways', [\App\Http\Controllers\PaymentController::class, 'PaymentGateways'])->name('payment_gateways');
Route::get('withdraw', [\App\Http\Controllers\Admin\SettingsController::class, 'withdraw'])->name('withdraw_settings');

//Route::group(['prefix' => 'payments'], function () {
Route::resource('payments', \App\Http\Controllers\PaymentController::class);
//    Route::get('view/{id}', [\App\Http\Controllers\PaymentController::class, 'view'])->name('payment_view');
//    Route::get('delete/{id}', [\App\Http\Controllers\PaymentController::class, 'delete'])->name('payment_delete');

//    Route::post('update-status/{id}', [\App\Http\Controllers\PaymentController::class, 'updateStatus'])->name('update_status');
//});

Route::get('withdraws', [\App\Http\Controllers\Admin\AdminController::class, 'withdrawsRequests'])->name('withdraws');

Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

//Route::group(['prefix' => 'users'], function () {
//    Route::get('/', ['as' => 'users', 'uses' => [\App\Http\Controllers\UserController::class, 'users']]);
//        Route::get('create', ['as'=>'add_administrator', 'uses' => 'UserController@addAdministrator']);
//        Route::post('create', ['uses' => 'UserController@storeAdministrator']);

//        Route::post('block-unblock', ['as'=>'administratorBlockUnblock', 'uses' => 'UserController@administratorBlockUnblock']);
//});

/*
 * Change Password route
 */
Route::group(['prefix' => 'account'], function () {
    Route::get('change-password', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('change_password');
    Route::post('change-password', [\App\Http\Controllers\UserController::class, 'changePasswordPost']);
});
