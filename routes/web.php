<?php

Route::get('/', function (){
    // return view('welcome');
    return redirect()->route('home');
});

Auth::routes();

Route::get('login/{site}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{site}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.social_callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('boards/{id}/like', 'BoardController@like')->name('boards.like');
Route::delete('boards/{id}/like', 'BoardController@unlike')->name('boards.unlike');
Route::post('boards/{id}/comments', 'BoardController@comments')->name('boards.comments');
Route::delete('boards/{id}/comments', 'BoardController@remove_comments')->name('boards.remove_comments');

Route::resources([
    'boards' => 'BoardController'
]);


Route::get('gallerys', 'GalleryController@index')->name('gallerys.index');
Route::get('gallerys/create', 'GalleryController@create')->name('gallerys.create');
Route::post('gallerys', 'GalleryController@store')->name('gallerys.store');
Route::get('gallerys/{id}', 'GalleryController@show')->name('gallerys.show');
Route::get('gallerys/{id}/edit', 'GalleryController@edit')->name('gallerys.edit');
Route::match(['patch', 'put'], 'gallerys/{id}', 'GalleryController@update')->name('gallerys.update');
Route::delete('gallerys/{id}', 'GalleryController@destroy')->name('gallerys.destroy');

Route::post('comments/{id}/like', 'CommentController@like')->name('comments.like');
Route::delete('comments/{id}/like', 'CommentController@unlike')->name('comments.unlike');

Route::get('users/{id}', 'UserController@show')->name('users.show');
Route::get('users/{id}/boards', 'UserController@boards')->name('users.boards');
Route::get('users/{id}/comments', 'UserController@comments')->name('users.comments');
Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
Route::match(['patch', 'put'], 'users/{id}', 'UserController@update')->name('users.update');

# attachment
Route::delete('attachments/{id}', 'AttachmentController@destroy')->name('attachments.destroy');


# user survey
Route::get('surveys/{event_id}', 'SurveyController@show')->name('surveys.show');
Route::get('surveys/{event_id}/create', 'SurveyController@create')->name('surveys.create');
Route::post('surveys/{event_id}', 'SurveyController@store')->name('surveys.store');

Route::group(['prefix' => 'adm', 'name' => 'adm.', 'middleware' => ['auth', 'can:isAdmin']], function(){

    Route::get('/', function(){
        return redirect()->route('adm.users.index');
    });

    Route::get('users', 'adm\\UserController@index')->name('adm.users.index');
    Route::get('users/{id}/edit', 'adm\\UserController@edit')->name('adm.users.edit');
    Route::match(['put', 'patch'], 'users/{id}/update', 'adm\\UserController@update')->name('adm.users.update');
    Route::delete('users/{id}', 'adm\\UserController@destroy')->name('adm.users.destroy');

    Route::get('users/{id}/boards', 'adm\\UserController@boards')->name('adm.users.boards');
    Route::get('users/{id}/comments', 'adm\\UserController@comments')->name('adm.users.comments');

    Route::get('banners', 'adm\\BannerController@index')->name('adm.banners.index');
    Route::get('banners/create', 'adm\\BannerController@create')->name('adm.banners.create');
    Route::post('banners/store', 'adm\\BannerController@store')->name('adm.banners.store');
    Route::get('banners/{id}/edit', 'adm\\BannerController@edit')->name('adm.banners.edit');
    Route::match(['put', 'patch'], 'banners/{id}/update', 'adm\\BannerController@update')->name('adm.banners.update');
    Route::delete('banners/{id}', 'adm\\BannerController@destroy')->name('adm.banners.destroy');

    Route::get('banners/categorys', 'adm\\BannerController@categorys')->name('adm.banners.categorys');

    Route::get('surveys', 'adm\\SurveyController@index')->name('adm.surveys.index');
    Route::get('surveys/create', 'adm\\SurveyController@create')->name('adm.surveys.create');
    Route::post('surveys/store', 'adm\\SurveyController@store')->name('adm.surveys.store');
    Route::get('surveys/{id}/edit', 'adm\\SurveyController@edit')->name('adm.surveys.edit');
    Route::match(['put', 'patch'], 'surveys/{id}', 'adm\\SurveyController@update')->name('adm.surveys.update');
    Route::delete('surveys/{id}/destroy', 'adm\\SurveyController@destroy')->name('adm.surveys.destroy');

});
