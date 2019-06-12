<?php

Route::get('/', 'welcomeController@index')->name('welcome');

// Route to get auth user data
Route::get('/user', 'HomeController@getUser');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Ranking
Route::get('/ranking', 'PostController@getRanking')->middleware('auth');

// Route fot posts
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

// Routes to like and dislike posts
Route::prefix('valorar')->group(function () {
    Route::post('/like', 'RateController@addLike');
    Route::post('/dislike', 'RateController@addDislike');
    Route::delete('/like/{post_id}', 'RateController@deleteLike');
    Route::delete('/dislike/{post_id}', 'RateController@deleteDislike');
});

// Route to select and notify winner
Route::post('winner', 'WinnerController@index')->name('winner');