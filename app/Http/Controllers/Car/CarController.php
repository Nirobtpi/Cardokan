<?php

namespace App\Http\Controllers\Car;

use App\Models\User;
use App\Models\Car\Car;
use App\Models\Car\Feature;
use App\Models\Car\CarBrand;
use App\Models\Country\City;
use Illuminate\Http\Request;
use App\Models\Country\Country;
use App\Http\Requests\CarRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::with('user','brand','features')->get();
        return view("admin.car.car.index", compact("cars"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties=Country::all();
        $features=Feature::all();
        $brands=CarBrand::where('status','=','1')->get();
        $users=User::all();
        return view("admin.car.car.create", compact("counties","features","users",'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
       $request->validated();
       $car = [
        'purpose'=> $request->purpose,
        'user_id'=> $request->dealer,
        'name'=> $request->title,
        'slug'=>$request->slug,
        'brand_id'=>$request->brand,
        'country_id'=>$request->country,
        'city_id'=>$request->city,
        'rent_period'=>$request->rent_period,
        'price'=>$request->regular_price,
        'offer_price'=>$request->offer_price,
        'description'=>$request->description,
        'seller_type'=>$request->seller_type,
        'body_type'=>$request->body_type,
        'engine_size'=>$request->engine_size,
        'drive'=>$request->drive,
        'interior_color'=>$request->interior_color,
        'exterior_color'=>$request->exterior_color,
        'year'=>$request->year,
        'mileage'=>$request->mileage,
        'total_owner'=>$request->total_owner,
        'fuel_type'=>$request->fuel_type,
        'transmission'=>$request->transmission,
        'car_model'=>$request->car_model,
        'is_approve'=>0,
        'car_condition'=>$request->car_condition,
        'popular'=>$request->popular ?? 'off',
        'feature'=>$request->car_feature ?? 'off',
       ];

       if($request->hasFile('car_image')){
            $file=$request->file('car_image');

            $filename= time().'.'.$file->getClientOriginalExtension();
            // return $filename;

            $file->move(public_path('uploads/cars'), $filename);

            $car['image']='uploads/cars/'.$filename;
       }

      $cars= Car::create($car);

       $cars->features()->sync($request->feature);

       return redirect()->route('car.create')->with(['message'=>'Car Create Successfully','alert-type'=>'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function cities($id){
        $city=City::where('country_id',$id)->get();
        // return $city;
        return response()->json($city);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $car=Car::with('features')->findOrFail($id);
        $countries=Country::all();
        $city=City::where('id','=',$car->city_id)->first();
        $features=Feature::all();
        $brands=CarBrand::where('status','=','1')->get();
        $users=User::all();
        // Session::put('name','Nirob');
        return view('admin.car.car.edit',compact('car','features','countries','brands','users','city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, string $id)
    {
        $car=Car::findOrFail($id);

        $request->validated();

        $carUpdate = [
        'purpose'=> $request->purpose,
        'user_id'=> $request->dealer,
        'name'=> $request->title,
        'slug'=>$request->slug,
        'brand_id'=>$request->brand,
        'country_id'=>$request->country,
        'city_id'=>$request->city,
        'rent_period'=>$request->rent_period,
        'price'=>$request->regular_price,
        'offer_price'=>$request->offer_price,
        'description'=>$request->description,
        'seller_type'=>$request->seller_type,
        'body_type'=>$request->body_type,
        'engine_size'=>$request->engine_size,
        'drive'=>$request->drive,
        'interior_color'=>$request->interior_color,
        'exterior_color'=>$request->exterior_color,
        'year'=>$request->year,
        'mileage'=>$request->mileage,
        'total_owner'=>$request->total_owner,
        'fuel_type'=>$request->fuel_type,
        'transmission'=>$request->transmission,
        'car_model'=>$request->car_model,
        'car_condition'=>$request->car_condition,
        'popular'=>$request->popular ?? 'off',
        'feature'=>$request->car_feature ?? 'off',
       ];


       if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName=time().'.'. $file->getClientOriginalExtension();
            $file->move(public_path('uploads/car/'), $fileName);

            if($car->image && file_exists(public_path($car->image))){
                unlink(public_path($car->image));
            };
            $carUpdate['image']=$fileName;
       }else{
        $carUpdate['image'] = $car->image;
       }
       $car->update( $carUpdate );

      $car->features()->sync($request->feature ?? []);
      return back()->with(['message'=>'Car Create Successfully','alert-type'=>'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car=Car::findOrFail($id);
        if($car->image && file_exists(public_path($car->image))){
            unlink(public_path($car->image));
        }
        $car->delete();
        return redirect()->route('car.index')->with(['message'=> 'Car Delete Successfully!','alert-type'=>'success']);
    }

    // status check

    public function statusUpdate(Request $request,$id){
        $car=Car::findOrFail($id);
        if($car->is_approve == 1){
            $car->is_approve = 0;
        }else{
            $car->is_approve = 1;
        }
        $car->update();
        // return redirect()->route('car.index')->with(['message'=>'Car Status Updated Successfully','alert-type'=>'success']);
        return response()->json([
            'message' => 'Car Status Updated Successfully!',
        ]);
    }
    public function awaitingForApproval(){
        $cars=Car::where('is_approve',0)->get();
        return view('admin.car.car.awaiting-for-approval',compact('cars'));
    }
}
