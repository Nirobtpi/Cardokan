<?php

namespace App\Http\Controllers\Admin\Plan;

use App\Models\Plan;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        //
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
