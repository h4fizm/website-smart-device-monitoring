<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


Route::group(["middleware" => 'auth'], function () {
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Get all sites from the database
    $sites = \App\Models\Site::pluck('name');
    foreach ($sites as $site) {
        $routeName = strtolower(str_replace(' ', '-', $site));

        // Use a closure to pass the $site parameter to the SitesController@index method
        Route::get("/sites/{$routeName}", function () use ($site) {
            return app(SitesController::class)->index($site);
        })->name("sites.{$routeName}");

        // Add an index route for each site
        Route::get("/sites/{$routeName}/index", function () use ($site) {
            return app(SitesController::class)->index($site);
        })->name("sites.index.{$routeName}");  // Adjust the name to make it unique for each site
    }
    Route::get("/sites/{site}/device/{deviceId}", [SitesController::class, 'deviceDetail'])
        ->name("sites.device.detail");
    Route::get('/devices/{deviceId}/source-data', [SitesController::class, 'getSourceData'])
        ->name("sites.device.detail.source");
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/report/{site_id}', [ReportController::class, 'getDeviceBySiteId']);
    // Site & Device Report
    Route::prefix('info')->group(function () {
        Route::get('/list-site', [SitesController::class, 'listSite'])->name('info.list_site');
        Route::get('/list-device', [SitesController::class, 'listDevice'])->name('info.list_device');
    });
    // Add Site
    Route::prefix('new')->group(function () {
        Route::get('/add-site', [SitesController::class, 'addSite'])->name('new.add_site');
        Route::post('/store-site', [SitesController::class, 'storeSite'])->name('store_site');
    });
    // Delete Site
    Route::prefix('sites')->group(function () {
        Route::get('/', [SitesController::class, 'listSite'])->name('sites.list');
        Route::delete('/delete/{siteId}', [SitesController::class, 'delete'])->name('sites.delete');
    });
    // Edit Site
    Route::get('/sites/{SiteId}/edit', [SitesController::class, 'edit'])->name('sites.edit');
    Route::put('/sites/{SiteId}/update', [SitesController::class, 'update'])->name('sites.update');
    // Add Device
    Route::prefix('new')->group(function () {
        Route::get('/add-device', [SitesController::class, 'addDevice'])->name('new.add_device');
        Route::post('/store-device', [SitesController::class, 'storeDevice'])->name('store_device');
    });
    // Edit Device
    Route::get('/devices/{deviceId}/edit', [DeviceController::class, 'edit'])->name('devices.edit');
    Route::put('/devices/{deviceId}/update', [DeviceController::class, 'update'])->name('devices.update');
    // Delete Device 
    Route::delete('/devices/{id}', [DeviceController::class, 'delete'])->name('devices.delete');
    Route::get('/menu/reportDevice', [DeviceController::class, 'index'])->name('menu.reportDevice');
    // Filter Device by Site
    Route::get('/report/{site_id}', [ReportController::class, 'getDeviceBySiteId']);
    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
    // User Account
    Route::get('/user-account', [UserController::class, 'index'])->name('user.account');
    // Add User Account
    Route::prefix('new')->group(function () {
        Route::get('/add-user', [UserController::class, 'addUser'])->name('new.add_user');
        Route::post('/store-user', [UserController::class, 'storeUser'])->name('store_user');
    });
    // Edit User
    Route::get('/users/{userId}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{userId}/update', [UserController::class, 'update'])->name('users.update');
    // Delete User 
    Route::delete('/users/{userId}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/delete', [UserController::class, 'index'])->name('report.users');

});


