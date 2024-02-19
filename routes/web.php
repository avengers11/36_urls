<?php

use Illuminate\Support\Facades\Route;

// users
use App\Http\Controllers\frontend\users\users_frontend_accounts_controller;
use App\Http\Controllers\frontend\users\users_frontend_deshbord_controller;

// admin
use App\Http\Controllers\frontend\admin\admin_frontend_accounts_Controller;
use App\Http\Controllers\frontend\admin\admin_frontend_users_Controller;
use App\Http\Controllers\frontend\admin\admin_frontend_setting_Controller;
use App\Http\Controllers\frontend\admin\admin_frontend_reseller_controller;
use App\Http\Controllers\frontend\admin\admin_frontend_urls_controller;
use App\Models\Device;

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

Route::middleware(['users'])->group(function () {
    Route::get('/', [users_frontend_deshbord_controller::class, 'users_home_controller']) -> name('users_home_web');
    Route::get('/ads/{url}', [users_frontend_deshbord_controller::class, 'users_ads_controller']) -> name('users_ads_web');
    Route::get('/ads/custom', [users_frontend_deshbord_controller::class, 'users_ads_custom_controller']) -> name('users_ads_custom_web');
    Route::get('/404', [users_frontend_deshbord_controller::class, 'users_404_controller']) -> name('users_404_web');
});
Route::get('/update', [users_frontend_deshbord_controller::class, 'users_update_controller']) -> name('users_update_web');

Route::get('links/{uniqeKey?}', [admin_frontend_urls_controller::class, 'admin_urls_links_controller']) -> name('settings.urls_admin_urls_links_web');
Route::get('accounts', [users_frontend_accounts_controller::class, 'users_accounts_controller']) -> name('users_accounts_web');


// admin
Route::prefix('admin')->group(function () {
    Route::get('', [admin_frontend_accounts_Controller::class, 'admin_accounts_controller'])->name('admin');
    Route::get('accounts', [admin_frontend_accounts_Controller::class, 'admin_accounts_controller']) -> name('admin_accounts_web');

    Route::middleware(['admin'])->group(function () {

        // users
        Route::prefix('users')->group(function () {
            Route::get('update/{id}', [admin_frontend_users_Controller::class, 'admin_users_update_controller']) -> name('users.admin_update_web');
            Route::get('add', [admin_frontend_users_Controller::class, 'admin_users_add_controller']) -> name('users.admin_add_web');
            Route::get('all', [admin_frontend_users_Controller::class, 'admin_users_all_controller']) -> name('users.admin_all_web');
            Route::get('ban', [admin_frontend_users_Controller::class, 'admin_users_ban_controller']) -> name('users.admin_ban_web');
        });

        // category
        Route::prefix('category')->group(function () {
            Route::get('all', [admin_frontend_setting_Controller::class, 'admin_category_all_controller']) -> name('category.admin_all_web');
            Route::get('update/{id}', [admin_frontend_setting_Controller::class, 'admin_category_update_controller']) -> name('category.admin_update_web');
            Route::get('add', [admin_frontend_setting_Controller::class, 'admin_category_add_controller']) -> name('category.admin_add_web');
            Route::get('ban', [admin_frontend_setting_Controller::class, 'admin_category_ban_controller']) -> name('category.admin_ban_web');
        });

        // reseller
        Route::prefix('reseller')->group(function () {
            Route::get('update/{id}', [admin_frontend_reseller_controller::class, 'admin_reseller_update_controller']) -> name('reseller.admin_update_web');
            Route::get('add', [admin_frontend_reseller_controller::class, 'admin_reseller_add_controller']) -> name('reseller.admin_add_web');
            Route::get('all', [admin_frontend_reseller_controller::class, 'admin_reseller_all_controller']) -> name('reseller.admin_all_web');
            Route::get('ban', [admin_frontend_reseller_controller::class, 'admin_reseller_ban_controller']) -> name('reseller.admin_ban_web');
        });

        Route::prefix('settings')->group(function () {
            // update
            Route::get('update-links', [admin_frontend_setting_Controller::class, 'admin_settings_update_links_controller']) -> name('settings.admin_update_links_web');

            Route::get('contact', [admin_frontend_setting_Controller::class, 'admin_settings_contact_controller']) -> name('settings.admin_contact_web');

            // urls
            Route::prefix('urls')->group(function () {
                Route::get('', [admin_frontend_urls_controller::class, 'admin_urls_controller']) -> name('settings.urls_admin_urls_web');
                Route::get('add/{id?}', [admin_frontend_urls_controller::class, 'admin_urls_add_controller']) -> name('settings.urls_add_admin_urls_web');
                Route::get('add-default', [admin_frontend_urls_controller::class, 'admin_urls_add_default_controller']) -> name('settings.urls_add_default_admin_urls_web');
                Route::get('update/{url}/{id?}', [admin_frontend_urls_controller::class, 'admin_urls_update_controller']) -> name('settings.urls_update_admin_urls_web');
            });
        });

    });
});

Route::get('test', function(){
    $de = Device::where('username', '2')->pluck('username')->toArray();
    return in_array('23', $de);
});
