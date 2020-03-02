<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth:api']], function(){

    Route::get('boards', 'api\\v1\\BoardController@index')->name('api.boards.index');
    Route::post('boards', 'api\\v1\\BoardController@store')->name('api.boards.store');
    Route::get('boards/{id}', 'api\\v1\\BoardController@show')->name('api.boards.show');
    Route::match(['patch', 'put'], 'boards/{id}', 'api\\v1\\BoardController@update')->name('api.boards.update');
    Route::delete('boards/{id}', 'BoardController@destroy')->name('api.boards.destroy');

    Route::post('boards/{id}/comment', 'api\\v1\\BoardController@comment')->name('api.boards.comment');
    Route::delete('boards/{id}/comment', 'api\\v1\\BoardController@uncomment')->name('api.boards.uncomment');

    Route::get('banners', 'api\\v1\\BannerController@index');

});
