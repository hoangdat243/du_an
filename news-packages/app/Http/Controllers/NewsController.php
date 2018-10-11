<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data= App\News::all();
        $category= App\NewsCategory::all();
        // var_dump($data->toArray());
        return view('news.index',compact('data','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $category= App\NewsCategory::all();
        $tag= App\Tag::all();
        return view('news.add',compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news= new App\News;
        $news->name= $request->txtName;
        $news->meta_title= $request->txtMetaTiTle;
        if (isset($request->txtSlug)) {
            $news->slug= $request->txtSlug;
        }
        else{
            $news->slug= str_slug($request->txtName,'-');
        }
        $news->meta_title= $request->txtMetaTitle;
        $news->short_description=$request->txtShortDescription;
        $news->meta_description= $request->txtDescription;
        $news->content=$request->content ;
        $news->status= $request->rdStatus;
        $news->author_id= 1;
        $news->category_id= $request->slCategory;
        
        if (isset($request->fImage)) {
            $file = $request->fImage;
            $name=$file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $tmp=$file->getRealPath();
            $file->move('uploads/images', $file->getClientOriginalName());
            $news->image=  "/uploads/images/".$name; 
        }
        $news->save();
        $news->Tag()->attach($request->slTag);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data= App\News::where('slug',$id)->get();
        var_dump($data->toArray());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data= App\News::find($id);
        $category=App\NewsCategory::all();
        $tag=App\Tag::all();
      
        return view('news.edit',compact('data','category','tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news= App\News::find($id);
        $news->name= $request->txtName;
        $news->meta_title= $request->txtMetaTiTle;
        if (isset($request->txtSlug)) {
            $news->slug= $request->txtSlug;
        }
        else{
            $news->slug= str_slug($request->txtName,'-');
        }
        $news->meta_title= $request->txtMetaTitle;
        $news->short_description=$request->txtShortDescription;
        $news->meta_description= $request->txtDescription;
        $news->content=$request->content ;
        $news->status= $request->rdStatus;
        $news->author_id= 1;
        $news->category_id= $request->slCategory;
        
        if (isset($request->fImage)) {
            $file = $request->fImage;
            $name=$file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $tmp=$file->getRealPath();
            $file->move('uploads/images', $file->getClientOriginalName());
            $news->image=  "/uploads/images/".$name; 
        }
        $news->save();
        $news->Tag()->detach();
        $news->Tag()->attach($request->slTag);
        return redirect('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $data = App\News::orderBy('id', 'desc');
        $data = $data->where(function ($q) use ($request) {
            if(!empty($request->name)){
                $q->where('name', 'like', '%' . $request->name . '%');
            }
            if(!empty($request->category)){
                $q->where('category_id',$request->category);
            }
            if(!empty($request->status)){
                $q->where('status', $request->status);
            }
           
        })->get();
       
       var_dump($data->toArray());
    }
    
}
