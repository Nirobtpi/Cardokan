<?php

namespace App\Http\Controllers\Country;


use App\Models\Country\City;
use Illuminate\Http\Request;
use App\Models\Country\Country;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::with('country','cars')->get();
        // $countries = Country::all();
        return view("admin.country.city.index", compact("cities"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view("admin.country.city.create", compact("countries"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string'],
            'country'=>['required'],
        ],[
            'name'=>'City name is required',
            'name.string'=>'City must be used in string',
            'country'=>'Country is required',
        ]);
        City::create([
            'name'=>$request->name,
            'country_id'=>$request->country,
        ]);
        return redirect()->route('city.index')->with(['message'=>'City added successfully','alert-type'=>'success']);
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
        $city= City::findOrFail($id);
        $countries = Country::all();
        return view('admin.country.city.edit', compact('city','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required','string'],
            'country'=>['required'],
        ],[
            'name'=>'City name is required',
            'name.string'=>'City must be used in string',
            'country'=>'Country is required',
        ]);
        City::findOrFail($id)->update([
            'name'=>$request->name,
            'country_id'=>$request->country,
        ]);

         return redirect()->route('city.index')->with(['message'=>'City updated successfully','alert-type'=>'success']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::findOrFail($id)->delete();
         return redirect()->route('city.index')->with(['message'=>'City updated successfully','alert-type'=>'success']);
    }
}
