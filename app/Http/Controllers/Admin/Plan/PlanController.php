<?php

namespace App\Http\Controllers\Admin\Plan;

use App\Models\Plan;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        $user=Admin::first();
        // return $user;
        return view("admin.plan.index", compact("plans"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->plan_name;
        $request->validate([
            'name'=>['required','string','unique:plans,name'],
            'price'=>['required','numeric'],
            'expiration_date'=>['required'],
            'features_car'=>['required','numeric'],
            'serial'=> ['required','numeric'],
            'maximum_cars'=>['required','numeric'],
        ],[
            'name.required'=>'Plan name is required',
            'name.string'=>'Plan name must be string',
            'name.unique'=>'Plan name must be unique',
            'expiration_date.required'=>'Plan expiration date is required',
            'price.required'=>'Plan price is required',
            'price.numeric'=>'Plan price must be numeric',
            'features_car.required'=>'Plan features car is required',
            'features_car.numeric'=>'Plan features car must be numeric',
            'serial.required'=>'Plan serial is required',
            'serial.numeric'=>'Plan serial must be numeric',
            'maximum_cars.required'=>'Plan maximum cars is required',
            'maximum_cars.numeric'=>'Plan maximum cars must be numeric',
        ]);
        $plan = [
            'name'=>$request->name,
            'price'=>$request->price,
            'maximum_cars'=>$request->maximum_cars,
            'features_car'=>$request->features_car,
            'serial'=>$request->serial,
            'plan_name'=>$request->plan_name,
            'status'=>$request->status??0,
        ];
        if($request->expiration_date == 'lifetime'){
            $plan['expair_date']='lifetime';
        }elseif($request->expiration_date == 'yearly'){
            $plan['expair_date']= Carbon::now()->addYear()->format('Y-m-d');
        }else{
            $plan['expair_date']= Carbon::now()->addMonth()->format('Y-m-d');
        }
        Plan::create($plan);
        $message = "Plan created successfully";
        return redirect()->route('plan.index')->with(['message'=>$message,'alert-type'=>'success']);
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
        $plan=Plan::findOrFail($id);
        return view('admin.plan.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $planName=Plan::findOrFail($id);

         $request->validate([
            'name'=>['required','string','unique:plans,name,'.$id],
            'price'=>['required','numeric'],
            'expiration_date'=>['required'],
            'features_car'=>['required','numeric'],
            'serial'=> ['required','numeric'],
            'maximum_cars'=>['required','numeric'],
        ],[
            'name.required'=>'Plan name is required',
            'name.string'=>'Plan name must be string',
            'name.unique'=>'Plan name must be unique',
            'expiration_date.required'=>'Plan expiration date is required',
            'price.required'=>'Plan price is required',
            'price.numeric'=>'Plan price must be numeric',
            'features_car.required'=>'Plan features car is required',
            'features_car.numeric'=>'Plan features car must be numeric',
            'serial.required'=>'Plan serial is required',
            'serial.numeric'=>'Plan serial must be numeric',
            'maximum_cars.required'=>'Plan maximum cars is required',
            'maximum_cars.numeric'=>'Plan maximum cars must be numeric',
        ]);
        $plan = [
            'name'=>$request->name,
            'price'=>$request->price,
            'maximum_cars'=>$request->maximum_cars,
            'features_car'=>$request->features_car,
            'serial'=>$request->serial,
            'plan_name'=>$request->plan_name,
            'status'=>$request->status??0,
        ];
        if($request->expiration_date == 'lifetime'){
            $plan['expair_date']='lifetime';
        }elseif($request->expiration_date == 'yearly'){
            $plan['expair_date']= Carbon::now()->addYear()->format('Y-m-d');
        }else{
            $plan['expair_date']= Carbon::now()->addMonth()->format('Y-m-d');
        }
        $planName->update($plan);
        $message = "Plan update successfully";
        return redirect()->route('plan.index')->with(['message'=>$message,'alert-type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        $message = "Plan deleted successfully";
        return redirect()->route('plan.index')->with(['message'=>$message,'alert-type'=>'success']);
    }
}
