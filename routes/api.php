<?php

use Illuminate\Support\Facades\Route;




Route::group([
    'namespace' => "App\Http\Controllers"
], function () {
    Route::group(
        [
            'middleware' => 'jwt.auth',
        ],
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
        }
    );

    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'
    ], function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('updateAvatar', 'AuthController@updateAvatar');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('verify', 'AuthController@verify');
        Route::get('me', 'AuthController@me');
        Route::post('updateExpo', 'AuthController@updateExpo');
    });
});
