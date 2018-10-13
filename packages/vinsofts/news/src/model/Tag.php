<?php

namespace Vinsofts\News;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table='tags';
    protected $fillable=['name','slug'];
    public $timestamps = false;

    public function News(){
        return $this->belongsToMany('App\Tag','news_tags','news_id','tags_id');
    }
   
}
