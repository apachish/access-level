<?php
Route::middleware('api')
    ->prefix('api')
    ->namespace('Apachish\AccessLevel\App\Http\Controllers')
    ->group(function () {

        Route::prefix('user')->group(function () {
            Route::middleware('guest')
                ->group(function () {
                    Route::post('/register', 'AuthController@register')->name("register");
                    Route::post('/login', 'AuthController@login')->name("login");
                });
        });

        Route::middleware('auth:api')->group(function () {
            Route::get('/send-email', 'UsersController@sendEmail');
            Route::post('refresh', 'AuthController@refresh');

            Route::prefix('items')->group(function () {
                Route::get('/', 'ItemController@gets');
                Route::get('/{item_id}', 'ItemController@get');
                Route::post('create', 'ItemController@store');
                Route::put('edit/{item_id}', 'ItemController@update');
                Route::delete('destroy/{item_id}', 'ItemController@destroy');
            });

        });

    });