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

Route::get('/', 'BlogController@index')->middleware('auth')->name('home');

Route::post('/comments/{blog_id}', 'CommentController@store')->name('user.comment.store');

Auth::routes();

Route::prefix('blogs')->middleware('auth')->group(function() {
    Route::get('/', 'BlogController@index')->name('blogs');

    Route::get('/create', 'BlogController@create')->name('user.blog.create');

    Route::post('/', 'BlogController@store')->name('user.blog.store');
    

    Route::get('/{blog}', 'BlogController@show')->name('user.blog.show');

    Route::get('/{blog}/edit', 'BlogController@edit')->name('user.blog.edit');

    Route::put('/{blog}', 'BlogController@update')->name('user.blog.update');

    Route::delete('/{blog}', 'BlogController@delete')->name('user.blog.delete');
});

