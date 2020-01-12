<?php


Route::middleware('auth')->group(function() {

    Route::get('/', 'AdminContrller@index')->name('admin');

    Route::prefix('user')->group(function(){
        Route::get('/', 'UserContrller@user')->name('admin.user.show');
        Route::delete('/{user}', 'UserContrller@userDelete')->name('admin.user.delete');
        Route::put('/edit/{user}', 'UserContrller@userUpdate')->name('admin.user.update');
    });

    Route::prefix('blog')->group(function(){
        Route::get('/', 'BlogController@blog')->name('admin.blog.show');
        Route::delete('/{blog}', 'BlogController@blogDelete')->name('admin.blog.delete');
        Route::put('/edit/{blog}', 'BlogController@blogUpdate')->name('admin.blog.update');
    });

    Route::prefix('comment')->group(function(){
        Route::get('/{blog}', 'CommentController@comment')->name('admin.comment.show');
        Route::delete('/{comment}', 'CommentController@commentDelete')->name('admin.comment.delete');
        Route::put('/edit/{comment}', 'CommentController@commentUpdate')->name('admin.comment.update');
    });
});