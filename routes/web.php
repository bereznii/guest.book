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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//RESOURCE
Route::resources([
    'comment' => 'CommentController',
    'user' => 'UserController'
]);

//->middleware('verified')