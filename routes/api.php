<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){

    Route::get('boards', 'api\\v1\\BoardController@index')->name('api.v1.boards.index');
    Route::post('boards', 'api\\v1\\BoardController@store')->name('api.v1.boards.store');
    Route::get('boards/{id}', 'api\\v1\\BoardController@show')->name('api.v1.boards.show');
    Route::match(['patch', 'put'], 'boards/{id}', 'api\\v1\\BoardController@update')->name('api.v1.boards.update');
    Route::delete('boards/{id}', 'BoardController@destroy')->name('api.v1.boards.destroy');

    Route::get('banners', 'api\\v1\\BannerController@index');

});
