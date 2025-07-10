<?php namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class AdminController extends Controller {

    public function __construct(){
        $this->middleware('auth:admin')->except(['show_login_page', 'login']);
    }
    public function show_login_page() {
        if(Auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.logininfo.login');
    }

    public function login(Request $request) {
        $request->validate([ 'email'=> ['required', 'email'],
            'password'=>['required'],
            ], [ 'email.required'=> 'Email is required',
            'email.email'=> 'Email must be a valid email address',
            'password.required'=> 'Password is required',
            ]);
        $user=Admin::where('email', $request->email)->first();

        if($user) {
            if(Auth()->guard('admin')->attempt(['email'=> $request->email, 'password'=> $request->password])) {
                 $message= 'Login successful';
                return redirect()->route('admin.dashboard')->with(['message'=> $message, 'alert-type' => 'success']);
            }else{
                $message= 'Invalid credentials';
                // Log the failed login attempt
                return redirect()->route('admin.login')->with(['message'=> $message, 'alert-type' => 'error']);
            }
        }else{
            $message= 'Email not found';
            return redirect()->back()->with(['message'=> $message, 'alert-type' => 'error']);
        }
    }

    public function logout(Request $request) {
        Auth()->guard('admin')->logout();
        return redirect()->route('login')->with(['success'=> 'Logout successful']);
    }
}
