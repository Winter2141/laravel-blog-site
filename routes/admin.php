<?php


Route::prefix('adminpanel')->middleware('auth')->group(function() {

    Route::get('/', 'AdminContrller@index')->name('admin');

    Route::get('/user', 'AdminContrller@user')->name('admin.user.show');

    Route::get('/blog', 'AdminContrller@blog')->name('admin.blog.show');

    Route::get('/comment/{blog}', 'AdminContrller@comment')->name('admin.comment.show');

    Route::delete('/{user}', 'AdminContrller@userDelete')->name('admin.user.delete');

    Route::delete('/blog/{blog}', 'AdminContrller@blogDelete')->name('admin.blog.delete');

    Route::delete('/comment/{comment}', 'AdminContrller@commentDelete')->name('admin.comment.delete');

    Route::put('/edit/{user}', 'AdminContrller@userUpdate')->name('admin.user.update');

    Route::put('/blog/edit/{blog}', 'AdminContrller@blogUpdate')->name('admin.blog.update');

    Route::put('/comment/edit/{comment}', 'AdminContrller@commentUpdate')->name('admin.comment.update');

});