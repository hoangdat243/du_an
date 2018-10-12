<?php

namespace Vinsofts\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Auth;
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

        $data= News::all();
        $category= NewsCategory::all();
        return view('v::news.index',compact('data','category'));
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
        return view('v::news.add',compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users= Auth::user();
        $request->validate([
            'txtName' => 'required|unique:news,name|max:255', 
            'txtSlug' => 'max:255',
            'txtMetaTitle' => 'required|max:60',
            'txtShortDescription' => 'required|max:255',
            'txtDescription' => 'required|max:255',
            'txtCreate' => 'required',
            'content' => 'required',
            'slCategory' => 'required',
            'slTag' => 'required',
            'fImage' => 'required'

        ],[
            'txtName.required'  => 'Chưa nhập tên tin tức',
            'txtName.unique'    => 'Tên đã tồn tại',
            'txtName.max'       => 'Tên phải ít hơn 255 kí tự',
            'txtMetaTitle.required' => 'Chưa nhập Meta Title',
            'txtShortDescription.required' => 'Chưa nhập mô tả ngắn',
            'txtShortDescription.max' => 'Mô tả ngắn không được quá 255 kí tự',
            'txtMetaTitle.max'    => 'Meta Title không được quá 60 kí tự',
            'txtDescription.required' => 'Chưa nhập mô tả',
            'txtDescription.max' => 'Mô tả vượt quá 255 kí tự',
            'txtCreate.required' => 'Chưa nhập thời gian tạo',
            'content.required' => 'Chưa nhập nội dung tin tức',
            'slCategory.required' => 'Chưa chọn danh mục',
            'slTag.required' => 'Chưa chọn thẻ tag',
            'fImage.required' => 'Chưa chọn ảnh',
        ]);
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
        $news->author_id= $users->id;
        $news->category_id= $request->slCategory;
        $news->created_at=$request->txtCreate;
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
        return redirect('news');

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
      
        return view('v::news.edit',compact('data','category','tag'));
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
            'txtSlug' => 'max:255',
            'txtMetaTitle' => 'required|max:60',
            'txtShortDescription' => 'required|max:255',
            'txtDescription' => 'required|max:255',         
            'content' => 'required',
            'slCategory' => 'required',
            'slTag' => 'required',
        ],[
            'txtName.required'  => 'Chưa nhập tên tin tức',
            'txtName.max'       => 'Tên phải ít hơn 255 kí tự',
            'txtMetaTitle.required' => 'Chưa nhập Meta Title',
            'txtShortDescription.required' => 'Chưa nhập mô tả ngắn',
            'txtShortDescription.max' => 'Mô tả ngắn không được quá 255 kí tự',
            'txtMetaTitle.max'    => 'Meta Title không được quá 60 kí tự',
            'txtDescription.required' => 'Chưa nhập mô tả',
            'txtDescription.max' => 'Mô tả vượt quá 255 kí tự',
            'content.required' => 'Chưa nhập nội dung tin tức',
            'slCategory.required' => 'Chưa chọn danh mục',
            'slTag.required' => 'Chưa chọn thẻ tag',
            
        ]);
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
        
        if(isset($request->txtCreate)){
            $news->created_at=$request->txtCreate;
        }
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

        App\News::destroy($id);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $category= App\NewsCategory::all();
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
        return view('v::news.search',compact('data','category'));
    }
    
}
