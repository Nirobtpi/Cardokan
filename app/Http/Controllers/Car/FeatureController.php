<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features=Feature::all();
        return view('admin.car.feature.index',compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required'],
        ]);
        Feature::create([
            'name'=>$request->name,
        ]);
        return redirect()->route('feature.index')->with(['message'=>'Feature Created Successfully','alert-type'=>'success']);
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
        $feature=Feature::findOrFail($id);
        return view('admin.car.feature.edit',compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $featureUpdate=Feature::findOrFail($id);
        $request->validate([
            'name'=>['required'],
        ]);
        $featureUpdate->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('feature.index')->with(['message'=> 'Feature update successfully','alert-type'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Feature::findOrFail($id)->delete();
        return redirect()->route('feature.index')->with(['message'=> 'Feature Deleted Successfully','alert-type'=>'success']);
    }
}
