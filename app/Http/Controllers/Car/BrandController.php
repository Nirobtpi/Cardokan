<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\CarBrand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware("auth:admin");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = CarBrand::paginate(5);

        return view('admin.car.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();
       $request->validate([
            'brand_name'=>['required','unique:car_brands,brand_name'],
            'slug'=>['required','unique:car_brands,brand_slug'],
            'photo'=>['required','image','mimes:jpeg,png,jpg,gif,svg,webp','max:2048'],
            'status'=>['nullable'],
        ],[
            'brand_name'=>'The brand name is required.',
            'brand_name.unique'=>'The brand name must be unique.',
            'slug.required'=>'The slug is required.',
            'slug.unique'=>'The slug must be unique.',
            'photo.required'=>'The photo is required.',
            'photo.image'=>'The photo must be an image.',
            'photo.mimes'=>'The photo must be a file of type: jpeg, png, jpg, gif, svg,webp.',
            'photo.max'=>'The photo may not be greater than 2048 kilobytes.',
        ]);

        $brand=[
            'brand_name'=>$request->brand_name,
            'brand_slug'=>$request->slug,
            'status'=>$request->visibility ?? 0, // Default to 0 if not provided
        ];

        if($request->hasFile('photo')){
           $photo = $request->file('photo');
           $photoName = time().'.'.$photo->getClientOriginalExtension();
           $photo->move(public_path('uploads/brand'), $photoName);

           $brand['brand_logo']='uploads/brand/'.$photoName;
        }
        CarBrand::create($brand);

        $message='Brand created successfully.';
        return redirect()->route('brand.index')->with(['message'=>$message,'alert-type'=>'success']);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }
    public function status(string $id)
    {
        $brand=CarBrand::findOrFail($id);
         
        if($brand->status == 1){
            $brand->status = 0;
        }else{
            $brand->status = 1;
        }
        $brand->update();

        return redirect()->route('brand.index')->with(['message'=>'Brand status updated successfully.','alert-type'=>'success']);
    }
        /**
     * live search without page load.
    */
    public function search(Request $request){
        // return 'ok';
         $query = $request->get('search');
        
       $brands = CarBrand::where(function($q) use ($query) {
        $q->where('brand_name', 'like', '%' . $query . '%')
          ->orWhere('brand_slug', 'like', '%' . $query . '%');
        })->get();

        return response()->json($brands);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand=CarBrand::findOrFail($id);
        return view('admin.car.brand.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'brand_name'=>['required','unique:car_brands,brand_name,'.$id],
            'slug'=>['required','unique:car_brands,brand_slug,'.$id],
            'photo'=>['image','mimes:jpeg,png,jpg,gif,svg,webp','max:2048'],
            'status'=>['nullable'],
        ],[
            'brand_name'=>'The brand name is required.',
            'brand_name.unique'=>'The brand name must be unique.',
            'slug.required'=>'The slug is required.',
            'slug.unique'=>'The slug must be unique.',
            'photo.image'=>'The photo must be an image.',
            'photo.mimes'=>'The photo must be a file of type: jpeg, png, jpg, gif, svg,webp.',
            'photo.max'=>'The photo may not be greater than 2048 kilobytes.',
        ]);
        $brand_update=CarBrand::findOrFail($id);
        $brand=[
            'brand_name'=>$request->brand_name,
            'brand_slug'=>$request->slug,
            'status'=>$request->visibility ?? 0, // Default to 0 if not provided
        ];
        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $fileName=time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/brand'), $fileName);
            $brand['brand_logo']='uploads/brand/'.$fileName;
            
            if(!empty($brand_update->brand_logo) && file_exists(public_path($brand_update->brand_logo))){
                unlink(public_path($brand_update->brand_logo));
            }
        }
        $brand_update->update($brand);

        return redirect()->route('brand.index')->with(['message'=>'Brand updated successfully.','alert-type'=>'success']);
    }
    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $carbrand_image=CarBrand::findOrFail($id);
         if(!empty($carbrand_image->brand_logo) && file_exists(public_path($carbrand_image->brand_logo))){
                unlink(public_path($carbrand_image->brand_logo));
            }
        $carbrand_image->destroy($id);
        return redirect()->route('brand.index')->with(['message'=>'Brand deleted successfully.','alert-type'=>'success']);
    }
}
