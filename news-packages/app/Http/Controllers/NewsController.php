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
        // var_dump($data->toArray());
        return view('addNews');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author= App\NewsAuthor::all();
        $category= App\NewsCategory::all();
        $tag= App\Tag::all();
        return view('addNews',compact('author','category','tag'));
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
        $news->meta_tiltle= $request->txtMetaTiTle;
       //$news->slug= "add-new-2";
        $news->content=$request->content ;
        $news->status= $request->rdStatus;
        $news->author_id= $request->slAuthor;
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
        //
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
}
