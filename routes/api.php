<?php

use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;


Route::group([
    'namespace' => "App\Http\Controllers",
    'middleware' => ["lang", 'req_log'],
], function () {
    Route::group(
        [],
        function () {
            Route::group(
                [
                    'namespace' => "Valute",
                    'prefix' => 'valute',
                    'middleware' => ['cache']
                ],
                function () {
                    Route::get('', 'IndexController');
                    Route::get('{code}', 'ShowController');
                }
            );

            Route::group(
                [
                    'namespace' => "News",
                    'prefix' => 'news',
                    'middleware' => ['cache']
                ],
                function () {
                    Route::get('', 'IndexController');
                }
            );

            Route::group(
                [
                    'namespace' => "Favorite",
                    'prefix' => 'favorite',
                ],
                function () {
                    Route::get('', 'IndexController');
                    Route::delete('{id}', 'RemoveController');
                    Route::post('', 'StoreController');
                }
            );

            Route::group(
                [
                    'namespace' => "FavoriteOption",
                    'prefix' => 'favoriteOptions',
                ],
                function () {
                    Route::delete('{id}', 'RemoveController');
                    Route::post('{favoriteId}', 'StoreController');
                }
            );

            Route::group(
                [
                    'namespace' => "Chat",
                    'prefix' => 'chat',
                ],
                function () {
                    Route::delete('{id}', 'RemoveController');
                    Route::get('{id}', 'ShowController');
                    Route::post('{chatId}', 'StoreController');
                }
            );

            Route::group(
                [
                    'namespace' => "Settings",
                    'prefix' => 'settings'
                ],
                function () {
                    Route::get('', 'IndexController');
                    Route::post('', 'StoreController');
                }
            );

            Route::group(
                [
                    'namespace' => "QueryHelper",
                    'prefix' => 'queryHelper',
                    'middleware' => ['cache']
                ],
                function () {
                    Route::get('', 'IndexController');
                }
            );
        }
    );

    Route::group([
        'middleware' => ['api'],
        'prefix' => 'auth',
    ], function () {
        Route::post('register', 'AuthController@register')->name('register');
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::patch('updateAvatar', 'AuthController@updateAvatar')->name('updateAvatar');
        Route::post('refresh', 'AuthController@refresh')->name(name: 'refresh');
        Route::post('verify/{token}', 'AuthController@verify')->name('verify');
        Route::get('me', 'AuthController@me')->name('me');
        Route::patch('updateExpo', 'AuthController@updateExpo')->name('updateExpo');
    });

    Route::group([
        'prefix' => 'password',
    ], function () {
        Route::post('/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
        Route::get('/reset/{token}/{email}', [PasswordResetController::class, 'showResetForm'])->middleware("web")->name('password.reset');
        Route::post('/reset', [PasswordResetController::class, 'resetPassword'])->name('password.update');
    });

    Route::get('test', 'TestController')->name('test');
});
