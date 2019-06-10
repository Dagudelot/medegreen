<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'welcomeController@index')->name('welcome');

Route::get('/user', 'HomeController@getUser');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('publicaciones')->group(function () {
    Route::get('/', 'PostController@index');
    Route::get('/{id}', 'PostController@show');
    Route::get('/{id}/getComments', 'PostController@getComments');
    Route::post('/', 'PostController@store');
    Route::put('/', 'PostController@update');
    Route::delete('/{id}', 'PostController@destroy');

    // Routes for comments on posts
    Route::prefix('comentarios')->group(function () {
        Route::post('/', 'CommentController@addComment');
        Route::put('/', 'CommentController@editComment');
        Route::delete('/{post_id}', 'CommentController@deleteComment');
    });
});

Route::prefix('valorar')->group(function () {
    Route::post('/like', 'RateController@addLike');
    Route::post('/dislike', 'RateController@addDislike');
    Route::delete('/like/{post_id}', 'RateController@deleteLike');
    Route::delete('/dislike/{post_id}', 'RateController@deleteDislike');
});
