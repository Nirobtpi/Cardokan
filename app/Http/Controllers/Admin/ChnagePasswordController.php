<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChnagePasswordController extends Controller
{
    public function __construct(){
        $this->middleware(('auth:admin'));
    }

    public function change_password(Request $request, $id)
    {
      $request->validate([
        'current_password'=>['required'],
        'password'=>['required','confirmed'],
      ],[
        'password.required'=> 'Password is required',
        'password.confirmed'=> 'Password confirmation does not match',
        'current_password.required'=> 'Current password is required',
      ]);

        $admin = Auth::guard('admin')->user()->findOrFail($id);
        if(Hash::check($request->current_password,$admin->password)){
            $admin->update([
                'password'=>Hash::make($request->password),
            ]);
            $message= 'Password changed successfully & you have been logged out';
            Auth::guard('admin')->logout(); // Logout the admin after password change
            return redirect()->route('admin.login')->with(['message'=>$message, 'alert-type'=>'success']);
        }else{
            $message= 'Current password is incorrect';
            return redirect()->back()->with(['message'=>$message, 'alert-type'=>'error']);
        }

    }
}
