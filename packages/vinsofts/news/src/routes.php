<?php

Route::group(['middleware' => ['web']], function () {
	//routes here
	Route::get('calculator', function(){
		echo 'Hello from the calculator package!';
	});
	Route::resource('news','Vinsofts\News\NewsController');
	Route::resource('news-categories','Vinsofts\News\NewsCategoryController');
	Route::resource('news-tag','Vinsofts\News\TagController');
	Route::get('search/news-tag','Vinsofts\News\TagController@search');
	Route::get('search/news-category','Vinsofts\News\NewsCategoryController@search');
	Route::get('search/news','Vinsofts\News\NewsController@search');
});

Route::prefix('api')->group(function () {
    Route::get('get_categories/{id}','Vinsofts\News\NewsAPIController@category');
Route::get('get_tags/{id}','Vinsofts\News\NewsAPIController@tag');
Route::get('get_news/detail/{id}','Vinsofts\News\NewsAPIController@newsDetail');
Route::get('get_posts_by_category/{id}','Vinsofts\News\NewsAPIController@getNewsByCategory');
Route::get('get_posts_by_tag/{id}','Vinsofts\News\NewsAPIController@getNewsByTag');
Route::get('get_posts_by_author/{id}','Vinsofts\News\NewsAPIController@getNewsByAuthor');
});

