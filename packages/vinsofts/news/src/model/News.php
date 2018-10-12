<?php

namespace Vinsofts\News;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table='news';
    protected $fillable=['name','meta_tiltle','slug','content','image','status'];
    public $timestamps = false;
    
    public function Category(){
        return $this->belongsTo('App\NewsCategory','category_id','id');
    }
    public function Author(){
        return $this->belongsTo('App\NewsAuthor','author_id','id');
    }
    public function Tag(){
        return $this->belongsToMany('App\Tag','news_tags','news_id','tags_id')  ;
    }
    
   
}
