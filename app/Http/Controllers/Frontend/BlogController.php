<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog\Blog;
use Illuminate\Http\Request;
use App\Models\Blog\BlogCategory;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index(Request $request){
        // $sessionId= session()->get('name','Nirob');
        // session()->put('name',$sessionId);
        $blogs=Blog::query();
        $resentBlogs=Blog::latest("id")->take(3)->get();
        $alltags=Blog::where('status','on')
                ->whereNotNull('tags')
                ->pluck('tags')
                ->map(function($tags){
                    return collect(json_decode($tags))->pluck('value');
                })
                ->flatten()
                ->unique()
                ->values();
        $categories=BlogCategory::where('status','on')->get();
        //  input search
        if($request->search){
            $blogs=$blogs->where('title','like','%'.$request->search.'%');
        }
        // category search
        if($request->category){
            $blogs=$blogs->whereHas('category',function($q) use ($request){
                $q->where('slug',$request->category);
            });
        }
        // tag search 
        if($request->tag){
            $blogs=$blogs->where(function($q) use ($request){
                $q->whereJsonContains('tags', ['value' => $request->tag])->orWhereJsonContains('tags',$request->tag);
            });
        }
        $blogs=$blogs->paginate(5);
        return view("frontend.blog",compact('blogs','resentBlogs','alltags','categories'));
    }
}
