<?php

Route::get('/', function (){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('boards/{id}/like', 'BoardController@like')->name('boards.like');
Route::delete('boards/{id}/like', 'BoardController@unlike')->name('boards.unlike');

Route::resources([
    'boards' => 'BoardController'
]);
