<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    use Sluggable;

    protected $table='news';
    protected $fillable=['name','meta_tiltle','slug','content','image','status'];
    protected $timestamp=true;
    
    public function Category(){
        return $this->belongsTo('App\NewsCategory','category_id','id');
    }
    public function Author(){
        return $this->belongsTo('App\NewsAuthor','author_id','id');
    }
    public function Tag(){
        return $this->belongsToMany('App\Tag','news_tags','news_id','tags_id');
    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    


}
