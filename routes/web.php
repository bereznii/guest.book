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

Route::get('/', 'BookController@index')->name('list');
Route::get('/profile/{id}', 'BookController@getProfile')->name('profile');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//action
Route::post('/comment', 'BookController@setComment')->middleware('auth')->name('comment');//->middleware('verified')
Route::delete('/destroy_comment/{id}', 'BookController@destroyComment')->middleware('auth')->name('destroyComment');//->middleware('verified')
Route::patch('/update_user/{id}', 'BookController@updateUser')->middleware('auth')->name('updateUser');