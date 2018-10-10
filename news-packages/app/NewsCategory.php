<?php

namespace App;
    
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{

    protected $table='news_categories';
    protected $fillable=['name','slug'];
    protected $timestamp=false;

    public function News(){
        return $this->hasMany('App\News','author_id','id');
    }
   
}
