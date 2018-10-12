<?php

Route::get('calculator', function(){
	echo 'Hello from the calculator package!';
});
Route::resource('news','Vinsofts\News\NewsController');
Route::resource('news-categories','Vinsofts\News\NewsCategoryController');
Route::resource('news-tag','Vinsofts\News\TagController');

Route::get('search/news-tag','Vinsofts\News\TagController@search');
Route::get('search/news-category','Vinsofts\News\NewsCategoryController@search');
Route::get('search/news','Vinsofts\News\NewsController@search');