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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-video', 'VideoController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/video', 'HomeController@video')->name('video');
Route::get('/getMyBaby', 'HomeController@getMyBaby')->name('getMyBaby');
