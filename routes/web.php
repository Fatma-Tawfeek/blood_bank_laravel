<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\GovernorateController;


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

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::group(['namespace' => 'front'], function() {
    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::get('/client-register', [AuthController::class, 'register'])->name('client.register');
    Route::post('/client-save', [AuthController::class, 'registerSave'])->name('client.save');
    Route::get('/client-login', [AuthController::class, 'login'])->name('client.login');
    Route::post('/login-check', [AuthController::class, 'loginCheck'])->name('login.check');
    Route::get('/logout-client', [AuthController::class, 'logout'])->name('client.logout');
    Route::get('/donations', [MainController::class, 'donationRequests'])->name('donation.requests');
    Route::get('/donations/{id}', [MainController::class, 'donationRequest'])->name('donation.request');
    Route::get('/posts/{id}', [MainController::class, 'post'])->name('post.details');
    Route::get('/about-us', [MainController::class, 'about'])->name('about');
    Route::get('/contact-us', [MainController::class, 'contact'])->name('contact');
    Route::post('/contact-send', [MainController::class, 'contactSend'])->name('contact.send');
    Route::post('/toggle-favourite', [MainController::class, 'toggleFavourite'])->name('toggle-favourite');

});


Route::middleware(['auth', 'auto-check-permission'])->group(function () {

    Route::get('home', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('governorates', GovernorateController::class);

    Route::resource('cities', CityController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('post', PostController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    Route::controller(ClientController::class)->group(function () {
        Route::prefix('clients')->group(function () {
            Route::get('/', 'index')->name('clients.index');
            Route::get('/{id}', 'show')->name('clients.show');
            Route::get('/status/{id}/{status_code}', 'updateStatus')->name('client.status');
            Route::delete('/{id}', 'destroy')->name('clients.destroy');
        });
    });

    Route::controller(DonationController::class)->group(function () {
        Route::prefix('donation-requests')->group(function () {
            Route::get('/', 'index')->name('donation.index');
            Route::get('/{id}', 'show')->name('donation.show');
            Route::delete('/{id}', 'destroy')->name('donation.destroy');
        });
    });

    Route::controller(ContactController::class)->group(function () {
        Route::prefix('contacts')->group(function () {
            Route::get('/', 'index')->name('contacts.index');
            Route::delete('/{id}', 'destroy')->name('contacts.destroy');
        });
    });

    Route::controller(SettingController::class)->group(function () {
        Route::prefix('settings')->group(function () {
            Route::get('/edit-settings', 'edit')->name('settings.edit');
            Route::put('/', 'update')->name('settings.update');
        });
    });

});

