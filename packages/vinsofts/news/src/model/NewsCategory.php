<?php

namespace Vinsofts\News;
    
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{

    protected $table='news_categories';
    protected $fillable=['name','slug'];
    public $timestamps = false;

    public function News(){
        return $this->hasMany('App\News','author_id','id');
    }
   
}
