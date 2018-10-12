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
Route::resource('news','NewsController');
Route::resource('news-categories','NewsCategoryController');
Route::resource('news-tag','TagController');

Route::get('search/news-tag','TagController@search');
Route::get('search/news-category','NewsCategoryController@search');
Route::get('search/news','NewsController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
