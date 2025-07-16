<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware("auth:admin");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("admin.user.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
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
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with(['message'=> 'User deleted successfully','alert-type'=>'success']);
    }

    public function status($id){
        $user = User::findOrFail($id);
        if($user->status ==='active'){
            $user->status=User::STATUS_INACTIVE;
        }else{
            $user->status=User::STATUS_ACTIVE;
        }
        $user->update();
        return response()->json([
            'message'=> 'User status updated successfully!',
        ] );
    }

    public function pendingUser(){
        $users=User::where('status','=','inactive')->get();
        return view('admin.user.pending-user',compact('users'));
    }
}
