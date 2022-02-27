<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;

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

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('governorates', [MainController::class, 'governorates']);
    Route::get('cities', [MainController::class, 'cities']);
    Route::get('blood-types', [MainController::class, 'bloodTypes']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password', [AuthController::class, 'reset']);
    Route::post('new-password', [AuthController::class, 'password']);

    Route::group(['middleware' => 'auth:api'], function () {
        route::post('register-token', [AuthController::class, 'registerToken']);
        route::post('remove-token', [AuthController::class, 'removeToken']);
        route::get('posts', [MainController::class, 'posts']);
        route::get('post', [MainController::class, 'post']);
        route::post('post-toggle-favourite', [MainController::class, 'postFavourite']);
        route::get('my-favourites', [MainController::class, 'myFavourites']);
        route::get('categories', [MainController::class, 'categories']);
        route::get('settings', [MainController::class, 'settings']);
        route::post('contact-us', [MainController::class, 'contact']);
        route::post('profile', [AuthController::class, 'profile']);
        route::get('get-notification-settings', [AuthController::class, 'getNotificationSettings']);
        route::post('notification-settings', [AuthController::class, 'notificationSettings']);
        route::post('donation-request-create', [MainController::class, 'donationRequestCreate']);
    });
});
