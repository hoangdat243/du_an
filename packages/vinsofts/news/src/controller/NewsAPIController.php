<?php

namespace Vinsofts\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
class NewsAPIController extends Controller
{
    public function category($id){
        $data=  NewsCategory::find($id);
        if($data==null){
            return response()->json($data,204);
        }else{
            return response()->json($data,200);
        }
    }
    public function tag($id){
        $data=  Tag::find($id);
        if($data==null){
            return response()->json($data,204);
        }else{
            return response()->json($data,200);
        }
    }
    public function newsDetail($id){
        $nID= News::find($id);
        if($nID==null){
            return response()->json('',204);
        }
        else{
            $data=  News::where('id',$id)->with("tag")->get();
            $news = ['id' => $data[0]['id'],
                    'name' => $data[0]['name'],
                    'slug' => $data[0]['slug'],
                    'category_id' => $data[0]['category_id'],
                    'author_id' => $data[0]['author_id'],
                    'image' => $data[0]['image'],
                    'create_at' => $data[0]['created_at'],
                    'content' => $data[0]['content'],
                    'meta_title' => $data[0]['meta_title'],
                    'meta_description' => $data[0]['meta_description'],
                    'status' => $data[0]['status'],
            ];     
            $tag=[];
            foreach($data[0]['tag'] as $v){
                array_push($tag,$v->id);
            }
            $news['tag_id']=$tag;

                return response()->json($news,200);
        }
       
        
    }

    public function getNewsByCategory($id){
        $nID= News::where('category_id',$id)->get();
        if(count($nID)<1){
            return response()->json('',204);
        }else{
            $data=  News::where('category_id',$id)->with("tag")->get();
            $arr2=[];
            $arr=[];
            foreach($data as $v){
                $arr = ['id' => $v['id'],
                'name' => $v['name'],
                'slug' => $v['slug'],
                'category_id' => $v['category_id'],
                'author_id' => $v['author_id'],
                'image' => $v['image'],
                'create_at' => $v['created_at'],
                'content' => $v['content'],
                'meta_title' => $v['meta_title'],
                'meta_description' => $v['meta_description'],
                'status' => $v['status'],
            ];  
            $tag=[];
            foreach($v['tag'] as $v){
                array_push($tag,$v->id);
            }
            $arr['tag_id']=$tag;   
            array_push($arr2,$arr);
            }   
            return response()->json($arr2,200);
        } 
    }
    public function getNewsByTag($id){
        $data=  News::with('tag')->whereHas('tag', function($q) use($id) {$q->where('tags_id', '=', $id); })->get();
        if(count($data)<1){
            return response()->json('không có dữ liệu',204);
        }else{
            $arr2=[];
            $arr=[];
            foreach($data as $v){
                $arr = ['id' => $v['id'],
                'name' => $v['name'],
                'slug' => $v['slug'],
                'category_id' => $v['category_id'],
                'author_id' => $v['author_id'],
                'image' => $v['image'],
                'create_at' => $v['created_at'],
                'content' => $v['content'],
                'meta_title' => $v['meta_title'],
                'meta_description' => $v['meta_description'],
                'status' => $v['status'],
            ];  
            $tag=[];
            foreach($v['tag'] as $v){
                array_push($tag,$v->id);
            }
            $arr['tag_id']=$tag;   
            array_push($arr2,$arr);
            }   
            return response()->json($arr2,200);
        }
    }

    public function getNewsByAuthor($id){
        $data=  News::where('author_id',$id)->with("tag")->get();
        if(count($data)<1){
            return response()->json('',204);
        }else{
            
            $arr2=[];
            $arr=[];
            foreach($data as $v){
                $arr = ['id' => $v['id'],
                'name' => $v['name'],
                'slug' => $v['slug'],
                'category_id' => $v['category_id'],
                'author_id' => $v['author_id'],
                'image' => $v['image'],
                'create_at' => $v['created_at'],
                'content' => $v['content'],
                'meta_title' => $v['meta_title'],
                'meta_description' => $v['meta_description'],
                'status' => $v['status'],
            ];  
            $tag=[];
            foreach($v['tag'] as $v){
                array_push($tag,$v->id);
            }
            $arr['tag_id']=$tag;   
            array_push($arr2,$arr);
            }   
            return response()->json($arr2,200);
        } 
    }


}