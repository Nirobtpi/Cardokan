<?php

namespace Modules\AdminTeam\App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\AdminTeam\App\Models\AdminRole;
use Modules\AdminTeam\App\Models\PermissionList;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminTeams = Admin::paginate(10);
        return view('adminteam::index', compact('adminTeams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = AdminRole::where('is_system_role', 0)->get();
        return view('adminteam::team.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
        ]);
        $adminTeam = new Admin();
        // Logic to create a new admin team member goes here
        if($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = 'admin_photo_' . time() . '.' . $extension;
            $request->file('photo')->move(public_path('uploads/admin/'), $filename);
            $adminTeam->photo = 'uploads/admin/' . $filename;
        }
        $adminTeam->name = $request->input('name');
        $adminTeam->email = $request->input('email');
        $adminTeam->password = Hash::make('1234'); // Set a default password or generate one
        $adminTeam->status=$request->status == 1 ? 'active' : 'inactive';
        $adminTeam->save();
        $notification = array(
            'message' => 'Admin Team Member Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('adminteam.index')->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('adminteam::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $adminTeam = Admin::findOrFail($id);
        $roles = AdminRole::where('is_system_role', 0)->get();
        return view('adminteam::team.edit', compact('adminTeam', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
         $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $adminTeam = Admin::findOrFail($id);
        // Logic to create a new admin team member goes here
        if($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename = 'admin_photo_' . time() . '.' . $extension;
            $request->file('photo')->move(public_path('uploads/admin/'), $filename);
            $adminTeam->photo = 'uploads/admin/' . $filename;
            if(file_exists(public_path($adminTeam->photo))) {
                unlink(public_path($adminTeam->photo));
            }
        }
        $adminTeam->name = $request->input('name');
        $adminTeam->email = $request->input('email');
        $adminTeam->password = Hash::make('1234'); // Set a default password or generate one
        $adminTeam->status=$request->status == 1 ? 'active' : 'inactive';
        $adminTeam->save();


        $adminTeam->roles()->sync($request->input('roles', []));

        $notification = array(
            'message' => 'Admin Team Member Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('adminteam.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}


    public function createRole(){
        $permissions = PermissionList::whereNull('parent_id')->with('children')->get();
        return view('adminteam::role.create', compact('permissions'));
    }

    public function storeRole(Request $request){

        // return $request->all();
        $request->validate([
            'name' => 'required|string|max:255|unique:admin_roles,name',
            'permissions' => 'required|array|min:1',
        ]);

        $role = new AdminRole();
        $role->name =strtolower(str_replace(' ', '_', $request->name));
        $role->display_name = $request->display_name;
        $role->description  = $request->description ;
        $role->status  = $request->status ;
        $role->save();

        if ($request->has('permissions')) {
            $permissions = [];

            // Add group permissions
            if (isset($request->permissions['groups'])) {
                $permissions = array_merge($permissions, $request->permissions['groups']);
            }

            // Add child permissions
            if (isset($request->permissions['children'])) {
                $permissions = array_merge($permissions, $request->permissions['children']);
            }

            // Remove duplicates and assign
            $permissions = array_unique($permissions);
            $role->permissions()->attach($permissions);
        }

        $notification = array(
            'message' => 'Admin Role Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('adminteam.index')->with($notification);
    }

    public function roleLists(){
        $roles = AdminRole::with('permissions')->paginate(10);
        // $permissions = PermissionList::whereNull('parent_id')->with('children')->get();
        return view('adminteam::role.index', compact('roles'));
    }

    public function roleUpdatePage($id){
        $role = AdminRole::with('permissions')->findOrFail($id);
        $permissions = PermissionList::whereNull('parent_id')->with('children')->get();
        $existingPermissions = $role->permissions->pluck('id')->toArray();
        return view('adminteam::role.edit', compact('role', 'permissions', 'existingPermissions'));
    }

    public function roleUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255|unique:admin_roles,name,'.$id,
            'permissions' => 'required|array|min:1',
        ]);

        $role = AdminRole::findOrFail($id);
        $role->name =strtolower(str_replace(' ', '_', $request->name));
        $role->display_name = $request->display_name;
        $role->description  = $request->description ;
        $role->status  = $request->status ;
        $role->save();

        // Sync permissions
        $permissions = [];

        // Add group permissions
        if (isset($request->permissions['groups'])) {
            $permissions = array_merge($permissions, $request->permissions['groups']);
        }

        // Add child permissions
        if (isset($request->permissions['children'])) {
            $permissions = array_merge($permissions, $request->permissions['children']);
        }

        // Remove duplicates and sync
        $permissions = array_unique($permissions);
        $role->permissions()->sync($permissions);

        $notification = array(
            'message' => 'Admin Role Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('adminteam.roleLists')->with($notification);
    }
}
