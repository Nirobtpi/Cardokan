<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
       $admin = Auth::guard('admin')->user();
        if(!$admin->hasPermissionTo('dashboard_access')){
            abort(403);
        }
        $cars = Car::all();
        $users=User::all();

        return view('admin.dashboard',compact('cars','users'));
    }
}
