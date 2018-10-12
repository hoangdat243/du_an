<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag= App\Tag::all();
        
        return view('tag.index',compact('tag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tag.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'txtName' => 'required|unique:tags,name|max:255',
            'txtMetaTitle' => 'required|max:60',
            'txtDescription' => 'required|max:255',
            'txtSlug' => 'unique:news_categories,name|max:255'
            
        ],[
            'txtName.required'  => 'Chưa nhập tên',
            'txtName.unique'    => 'Tên đã tồn tại',
            'txtName.max'       => 'Tên phải ít hơn 255 kí tự',
            'txtMetaTitle.required' => 'Chưa nhập Meta Title',
            'txtMetaTitle.max'    => 'Meta Title không được quá 60 kí tự',
            'txtDescription.required' => 'Chưa nhập mô tả',
            'txtSlug.unique' => 'Slug đã tồn tại',
            'txtName.max' => 'Slug vượt quá 255 kí tự',
        ]);


        $tag= new App\Tag;
        $tag->name= $request->txtName;
        if (isset($request->txtSlug)) {
            $tag->slug= $request->txtSlug;
        }
        else{
            $tag->slug= str_slug($request->txtName,'-');
        }
        $tag->meta_title= $request->txtMetaTitle;
        $tag->meta_description= $request->txtDescription;
        //add image
        if (isset($request->fImage)) {
            $file = $request->fImage;
            $name=$file -> getClientOriginalName();
            $file -> getClientOriginalExtension();
            $tmp=$file -> getRealPath();
            $file -> move('uploads/images', $file->getClientOriginalName());
            $tag -> image=  "/uploads/images/".$name;
        }else{ $tag -> image='';}
        $tag->save();
        return redirect()->back();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= App\Tag::find($id);
        return view('tag.edit',compact('data'));
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
        $request->validate([
            'txtName' => 'required|max:255',
            'txtMetaTitle' => 'required|max:60',
            'txtDescription' => 'required|max:255',
            'txtSlug' => 'max:255'
            
        ],[
            'txtName.required'  => 'Chưa nhập tên',
            'txtName.max'       => 'Tên phải ít hơn 255 kí tự',
            'txtMetaTitle.required' => 'Chưa nhập Meta Title',
            'txtMetaTitle.max'    => 'Meta Title không được quá 60 kí tự',
            'txtDescription.required' => 'Chưa nhập mô tả',
            'txtName.max' => 'Slug vượt quá 255 kí tự',
        ]);
        
        $tag= App\Tag::find($id);
        $tag->name= $request->txtName;
        $tag->slug= $request->txtSlug;
        $tag->meta_title= $request->txtMetaTitle;
        $tag->meta_description= $request->txtDescription;
        if (isset($request->fImage)) {
            $file = $request->fImage;
            $name=$file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $tmp=$file->getRealPath();
            $file->move('uploads/images', $file->getClientOriginalName());
            $tag->image=  "/uploads/images/".$name;
        }
        $tag->save();
        return redirect('news-tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        App\Tag::destroy($id);
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $tag= App\Tag::where('name','like','%'.$request->key.'%')->get();
       return view('tag.search',compact('tag'));
    }
}
