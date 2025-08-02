<?php

namespace App\Http\Controllers\Admin\Testimonial;

use App\Models\Blog\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Test;
use App\Http\Controllers\Controller;
use App\Models\Blog\BlogCategory;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $testimonials=Testimonial::all();
    //    $name= $testimonials->filter(function($val){
    //        return $val->status== "on";
    //    })->pluck("name");
        $blogs=Blog::with('category');
        if($request->tag){
            $blogs= Blog::where(function($query) use ($request) {
            $query->whereJsonContains('tags', ['value' => $request->tag])
            ->orWhereJsonContains('tags', $request->tag);
            });
        }
        if($request->category){
            $blogs=$blogs->whereHas('category',function($query) use ($request){
                $query->where('slug', $request->category);
            });
        }
        $category=BlogCategory::where('status','on')->get();
        // if ($request->tag) {
        //     $blogs = $blogs->where(function($query) use ($request) {
        //         $query->whereJsonContains('tags', ['value' => $request->tag])
        //             ->orWhereJsonContains('tags', $request->tag);
        //     });
        // }
        // $blogs=$blogs->get();
        // return $blogs;

        // $id=2;
        // $blogs=$blogs->whereHas('category', function($query) use ($id) {
        //     $query->where('id', $id);
        // })->get();

        return view("admin.testimonial.index",compact("testimonials",'category','blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.testimonial.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->status;
        $request->validate([
            "name"=> ['required','string','max:255'],
            'description'=>['required','string'],
            'photo'=>['required','image','mimes:jpeg,png,jpg,gif,svg,webp','max:2048'],
        ]);

        $data=[
            'name'=> $request->name,
            'description'=> $request->description,
            'designation'=> $request->designation,
            'status'=> $request->status ?? 'off',
        ];
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/testimonial/', $filename);
            $data['image'] = 'uploads/testimonial/'.$filename;
        }
        Testimonial::create($data);
        $message="Testimonial created successfully";
        return redirect()->route('testimonial.index')->with(['message'=>$message,'alert-type'=>'success']);
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
        $data=Testimonial::findOrFail($id);
        return view("admin.testimonial.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateData=Testimonial::findOrFail($id);
         $request->validate([
            "name"=> ['required','string','max:255'],
            'description'=>['required','string'],
            'photo'=>['image','mimes:jpeg,png,jpg,gif,svg,webp','max:2048'],
        ]);

        $data=[
            'name'=> $request->name,
            'description'=> $request->description,
            'designation'=> $request->designation,
            'status'=> $request->status ?? 'off',
        ];
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/testimonial/', $filename);
            $data['image'] = 'uploads/testimonial/'.$filename;

            if($updateData->image && file_exists(public_path('uploads/testimonial/'.$updateData->image))){
                unlink(public_path('uploads/testimonial/'.$updateData->image));
            }
        }
        $updateData->update($data);
        $message="Testimonial updated successfully";
        return redirect()->route('testimonial.index')->with(['message'=>$message,'alert-type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Testimonial::findOrFail($id);

        if($data->image && file_exists(public_path('uploads/testimonial/'.$data->image))){
            unlink(public_path('uploads/testimonial/'.$data->image));
        }
        $data->delete();
        $message="Testimonial deleted successfully";
        return redirect()->route('testimonial.index')->with(['message'=>$message,'alert-type'=>'success']);
    }

    // public function test(Request $request){

    //     $theme=$request->theme;
    //     if($theme =="nirob"){
    //     return "ok";
    //     }
    // }
}
