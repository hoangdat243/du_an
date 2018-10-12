<?php

namespace Vinsofts\News;

use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //load migrate
         
        $this->loadMigrationsFrom(__DIR__.'/migrations');
      
        //load controller
        include __DIR__.'/controller/NewsAPIController.php';
        include __DIR__.'/controller/NewsCategoryController.php';
        include __DIR__.'/controller/NewsController.php';
        include __DIR__.'/controller/TagController.php';
        //load model
        include __DIR__.'/model/News.php';
        include __DIR__.'/model/NewsCategory.php';
        include __DIR__.'/model/Tag.php';
        //load vies
        $this->loadViewsFrom(__DIR__.'/view','v');
        //route
        include __DIR__.'/routes.php';  
       
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
