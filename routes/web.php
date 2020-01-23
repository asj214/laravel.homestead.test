<?php

Route::get('/', function (){
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('boards/{id}/like', 'BoardController@like')->name('boards.like');
Route::delete('boards/{id}/like', 'BoardController@unlike')->name('boards.unlike');

Route::post('boards/{id}/comments', 'BoardController@comments')->name('boards.comments');
Route::delete('boards/{id}/comments', 'BoardController@remove_comments')->name('boards.remove_comments');

Route::resources([
    'boards' => 'BoardController'
]);

Route::get('users/{id}', 'UserController@show')->name('users.show');
Route::get('users/{id}/boards', 'UserController@boards')->name('users.boards');
Route::get('users/{id}/comments', 'UserController@comments')->name('users.comments');
Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
