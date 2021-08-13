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
            Route::middleware('auth:api')->group(function () {
                Route::get('/send-email', 'UsersController@sendEmail');
                Route::post('refresh', 'AuthController@refresh');

                Route::post('/add/author/{user_id}', 'UsersController@addAuthor');
            });
        });

        Route::middleware('auth:api')->group(function () {

            Route::apiResource("items","ItemController")->parameters([
                "items"=>'item_id'
            ]);

        });

    });
