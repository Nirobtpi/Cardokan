<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(){
        // Middleware to ensure admin is authenticated
         $this->middleware('auth:admin');
    }
    public function index(){
        // Logic to show the admin profile page
        $admin=Admin::find(Auth::guard('admin')->id());
        return view('admin.profile.index',compact('admin'));
    }    
    
    public function update_profile(Request $request, $id){
        $admin=Admin::findOrFail($id);
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:admins,email,'.$admin->id],
            'facebook'=>['url', 'nullable'],
            'linkedin'=>['url', 'nullable'],
            'twitter'=>['url', 'nullable'],
            'instagram'=>['url', 'nullable'],
            'photo'=>['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'email.unique' => 'Email already exists',
            'facebook.url' => 'Facebook must be a valid URL',
            'linkedin.url' => 'LinkedIn must be a valid URL',
            'twitter.url' => 'Twitter must be a valid URL',
            'instagram.url' => 'Instagram must be a valid URL',
            'photo.image' => 'Photo must be an image file',
            'photo.mimes' => 'Photo must be a file of type: jpeg, png, jpg, gif, svg',
            'photo.max' => 'Photo must not be larger than 2MB',
        ]);
        $data=[
            'name' => $request->name,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'designation' => $request->designation,
            'phone' => $request->phone,
            'about_me' => $request->about_me,
        ];

        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/admin/'), $filename);

            // If the admin already has a photo, delete the old one
            if($admin->photo && file_exists(public_path($admin->photo))) {
                unlink(public_path($admin->photo)); // Delete old photo if exists
            }
            // Store the new photo path in the data array
            $data['photo'] = 'uploads/admin/' . $filename;
        }
        $admin->update($data);

        $message = 'Profile updated successfully';
        return redirect()->route('admin.profile')->with(['message' => $message, 'alert-type' => 'success']);
    }
}
