<?php

namespace App\Http\Controllers\Admin\Blog;

use Illuminate\Http\Request;
use App\Models\Blog\BlogCategory;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = BlogCategory::all();
        return view("admin.blog.category.index", compact("categories"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.blog.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> ['required','string','unique:blog_categories,name'],
            'slug'=> ['required','string','unique:blog_categories,slug'],

        ],[
            'name.required'=>'Category name is required',
            'name.string'=>'Category name must be string',
            'name.unique'=>'Category name must be unique',
            'slug.required'=>'Category slug is required',
            'slug.string'=>'Category slug must be string',
            'slug.unique'=>'Category slug must be unique',
        ]);
        BlogCategory::create([
            'name'=> $request->name,
            'slug'=> $request->slug,
            'status'=> $request->status ??'off',
        ]);
        $message='Category created successfully';
        return back()->with(['message'=>$message,'alert-type'=> 'success']);
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
        $category = BlogCategory::findOrFail($id);
        return view('admin.blog.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category= BlogCategory::findOrFail($id);
         $request->validate([
            "name"=> ['required','string','unique:blog_categories,name,'.$id],
            'slug'=> ['required','string','unique:blog_categories,slug,'.$id],

        ],[
            'name.required'=>'Category name is required',
            'name.string'=>'Category name must be string',
            'name.unique'=>'Category name must be unique',
            'slug.required'=>'Category slug is required',
            'slug.string'=>'Category slug must be string',
            'slug.unique'=>'Category slug must be unique',
        ]);
        $category->update([
            'name'=> $request->name,
            'slug'=> $request->slug,
            'status'=> $request->status ??'off'
        ]);
        $message= 'Category updated successfully';
        return redirect()->route('blog-category.index')->with(['message'=>$message,'alert-type'=> 'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BlogCategory::destroy($id);
        $message= 'Category deleted successfully';
        return redirect()->route('blog-category.index')->with(['message'=>$message,'alert-type'=> 'success']);
    }
}
