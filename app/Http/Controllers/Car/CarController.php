<?php

namespace App\Http\Controllers\Car;

use App\Models\Car\CarBrand;
use App\Models\Country\City;
use App\Models\User;
use App\Models\Car\Car;
use App\Models\Car\Feature;
use Illuminate\Http\Request;
use App\Models\Country\Country;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view("admin.car.car.index", compact("cars"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties=Country::all();
        $features=Feature::all();
        $brands=CarBrand::all();
        $users=User::all();
        return view("admin.car.car.create", compact("counties","features","users",'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       return $request->feature;
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

        return response()->json($city);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
