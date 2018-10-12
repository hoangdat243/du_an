<?php

namespace App;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    use Sluggable;
    protected $table='tags';
    protected $fillable=['name','slug'];
    public $timestamps = false;

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
