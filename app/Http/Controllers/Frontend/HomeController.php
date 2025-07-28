<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car\Car;
use App\Models\Blog\Blog;
use App\Models\Car\CarBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CarBrand::where('status',1)->withCount('cars')->get();
        $cars=Car::where('is_approve',1)->get();
        $new_cars=Car::where('is_approve',1)->where('car_condition','new')->get();
        $used_cars=Car::where('is_approve',1)->where('car_condition','used')->get();
        $feature_car=Car::where('feature','on')->where('is_approve',1)->get();
        $blogs=Blog::where('status','on')->take(2)->latest()->get();
        // return $blogs;
        return view('frontend.index',compact('categories','cars','new_cars','used_cars','feature_car','blogs'));
    }
}
