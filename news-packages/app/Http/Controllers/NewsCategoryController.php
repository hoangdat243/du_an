<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class NewsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= App\NewsCategory::all();
        
        return view('category.category',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('category.add');
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
            'txtName' => 'required|unique:news_categories,name|max:255',
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


        $category= new App\NewsCategory;
        $category->name= $request->txtName;
        if (isset($request->txtSlug)) {
            $category->slug= $request->txtSlug;
        }
        else{
            $category->slug= str_slug($request->txtName,'-');
        }
        $category->meta_title= $request->txtMetaTitle;
        $category->meta_description= $request->txtDescription;
        //add image
        if (isset($request->fImage)) {
            $file = $request->fImage;
            $name=$file -> getClientOriginalName();
            $file -> getClientOriginalExtension();
            $tmp=$file -> getRealPath();
            $file -> move('uploads/images', $file->getClientOriginalName());
            $category -> image=  "/uploads/images/".$name;
        }else{ $category -> image='';}
        $category->save();
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
        $data= App\NewsCategory::find($id);
        return view('category.edit',compact('data'));
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
        
        
        $category= App\NewsCategory::find($id);
        $category->name= $request->txtName;
        $category->slug= $request->txtSlug;
        $category->meta_title= $request->txtMetaTitle;
        $category->meta_description= $request->txtDescription;
        if (isset($request->fImage)) {
            $file = $request->fImage;
            $name=$file->getClientOriginalName();
            $file->getClientOriginalExtension();
            $tmp=$file->getRealPath();
            $file->move('uploads/images', $file->getClientOriginalName());
            $category->image=  "/uploads/images/".$name;
        }
        $category->save();
        return redirect('news-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        App\NewsCategory::destroy($id);
        return redirect()->back();
    }
    
}
