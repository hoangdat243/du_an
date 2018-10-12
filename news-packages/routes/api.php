<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get_categories/{id}','NewsAPIController@category');
Route::get('get_tags/{id}','NewsAPIController@tag');
Route::get('get_news/detail/{id}','NewsAPIController@newsDetail');
Route::get('get_posts_by_category/{id}','NewsAPIController@getNewsByCategory');
Route::get('get_posts_by_tag/{id}','NewsAPIController@getNewsByTag');
Route::get('get_posts_by_author/{id}','NewsAPIController@getNewsByAuthor');

