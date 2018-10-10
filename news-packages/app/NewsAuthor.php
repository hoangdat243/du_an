<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class NewsAuthor extends Model
{
    //
    use Sluggable;
    protected $table='news_authors';
    protected $fillable=['name','slug'];
    protected $timestamp=false;

    public function News(){
        return $this->hasMany('App\News','author_id','id');
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
