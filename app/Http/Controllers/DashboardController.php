<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Car\Car;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $users=User::all();
        return view('admin.dashboard',compact('cars','users'));
    }
}
