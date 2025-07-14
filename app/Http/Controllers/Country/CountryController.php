<?php

namespace App\Http\Controllers\Country;

use Illuminate\Http\Request;
use App\Models\Country\Country;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::withCount('cars')->get();
        return view("admin.country.index", compact("countries"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string','unique:countries,name'],
        ],[
            'name.required'=>'Country name is required',
            'name.string'=>'Country name must be string',
            'name.unique'=>'Country name must be unique',
        ]);
        Country::create([
            'name'=> $request->name,
        ]);
        return redirect()->route('country.index')->with(['success'=>'Category created successfully','alert-type'=>'success']);

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
        $country = Country::findOrFail($id);
        return view('admin.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name'=>['required','string','unique:countries,name,'.$id],
        ],[
            'name.required'=>'Country name is required',
            'name.string'=>'Country name must be string',
            'name.unique'=>'Country name must be unique',
        ]);
        Country::findOrFail($id)->update([
            'name'=> $request->name,
        ]);
        return redirect()->route('country.index')->with(['message'=> 'Country update successfully','alert-type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Country::findOrFail($id)->delete();
        return redirect()->route('country.index')->with(['message'=> 'Country deleted successfully','alert-type'=>'success']);
    }
}
