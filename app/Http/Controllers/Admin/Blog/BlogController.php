<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use App\Models\Blog\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs=Blog::with('category')->get();
        return view("admin.blog.blog-tems.index",compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::all();
        return view("admin.blog.blog-tems.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=> ['required','string'],
            'slug'=> ['required','string','unique:blogs,slug'],
            'image'=> ['required','mimes:png,jpg,jpeg,webp,svg,gif'],
            'category'=> ['required'],
            'description'=> ['required'],
        ],[
            'title.required'=>'Title is required',
            'title.string'=>'Title must be string',
            'slug.required'=>'Slug is required',
            'slug.string'=>'Slug must be string',
            'slug.unique'=>'Slug must be unique',
            'image.required'=>'Image is required',
            'image.mimes'=>'Image must be png,jpg,jpeg,webp,svg,gif',
            'category.required'=>'Category is required',
            'description.required'=>'Description is required',
        ]);
        $data=[
            'title'=> $request->title,
            'slug'=> $request->slug,
            'blog_category_id'=> $request->category,
            'description'=> $request->description,
            'popular'=> $request->popular ??'off',
            'status'=> $request->status ?? 'off',
            'tags'=>$request->tags,
            'seo_title'=>$request->seo_title,
            'seo_description'=>$request->seo_description,
        ];

        if($request->hasFile('image')){
            $image= $request->file('image');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $data['image']='uploads/blogs/'.$imageName;
        }
        Blog::create($data);
        $message='Blog created successfully';
        return redirect()->route('blog.index')->with(['message'=>$message,'alert-type'=>'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
         $categories = BlogCategory::all();
        return view('admin.blog.blog-tems.edit', compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title"=> ['required','string'],
            'slug'=> ['required','string','unique:blogs,slug,'.$id],
            'image'=> ['mimes:png,jpg,jpeg,webp,svg,gif'],
            'category'=> ['required'],
            'description'=> ['required'],
        ],[
            'title.required'=>'Title is required',
            'title.string'=>'Title must be string',
            'slug.required'=>'Slug is required',
            'slug.string'=>'Slug must be string',
            'slug.unique'=>'Slug must be unique',
            'image.mimes'=>'Image must be png,jpg,jpeg,webp,svg,gif',
            'category.required'=>'Category is required',
            'description.required'=>'Description is required',
        ]);
        $data=[
            'title'=> $request->title,
            'slug'=> $request->slug,
            'blog_category_id'=> $request->category,
            'description'=> $request->description,
            'popular'=> $request->popular ??'off',
            'status'=> $request->status ?? 'off',
            'tags'=>$request->tags,
            'seo_title'=>$request->seo_title,
            'seo_description'=>$request->seo_description,
        ];
        $blog = Blog::findOrFail($id);
        if($request->hasFile('image')){
            $image= $request->file('image');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $imageName);
            $data['image']='uploads/blogs/'.$imageName;


            if($blog->image && file_exists(public_path($blog->image))){
                unlink(public_path($blog->image));
            }
        };

        $blog->update($data);
        $message='Blog update successfully';
        return redirect()->route('blog.index')->with(['message'=>$message,'alert-type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $blog= Blog::findOrFail($id);
        if($blog->image && file_exists(public_path($blog->image))){
            unlink(public_path($blog->image));
        }
        $blog->delete();
        $message='Blog deleted successfully';
        return redirect()->route('blog.index')->with(['message'=>$message,'alert-type'=>'success']);
    }

    public function clearCache()
    {
        Artisan::call('optimize:clear'); // This clears config, route, view, and cache together
        return back()->with(['message'=>'Cache Cleared Successfully!','alert-type'=>'success']);
    }
}
