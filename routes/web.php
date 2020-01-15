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


/** Posts */
Route::get('/post/create', 'PostControler@create')->name('create_post');
Route::post('/post/create', 'PostControler@store');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/posts', 'PostControler@index');

Route::get('/post/{postId}', 'PostControler@show')->name('show_post');
Route::delete('/post/{postId}', 'PostControler@destroy')->name('delete_post');
Route::put('/post/{postId}', 'PostControler@edit')->name('edit_post');
Route::post('/post/{postId}', 'PostControler@update')->name('update_post');
/** Categories */
Route::get('/categories', 'CategoryController@index')->name('list_categories');
Route::get('/category/create', 'CategoryController@create')->name('create_category');
Route::get('/category', 'CategoryController@store')->name('show_category');
Route::delete('/category/{categoryId}', 'CategoryController@destroy')->name('delete_category');
Route::get('/category/{categoryId}','CategoryController@update')->name('edit_category');
Route::put('/category/{categoryId}', 'CategoryController@edit')->name('update_category');
/** Comments */
Route::post('/post/{postId}/comment','CommentController@store')->name('create_comment');
Route::delete('/post/{postId}/comment','CommentController@destroy')->name('delete_comment');

Auth::routes();


