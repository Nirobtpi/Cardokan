<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Pest\Arch\Concerns\Architectable as AdminArchitectable;
use Modules\AdminTeam\App\Models\PermissionList;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    // use Authenticatable;
    protected $rediractTo = '/';
    const ACTIVE_STATUS='active';
    const INACTIVE_STATUS='inactive';
    protected $guarded=[];

    public function roles()
    {
        return $this->belongsToMany(
            \Modules\AdminTeam\App\Models\AdminRole::class,
            'admin_role_assign',
            'admin_id',
            'admin_role_id'
        );
    }


    public function getPermissionsViaRoles()
    {
        if($this->is_super_admin == 1){
            return PermissionList::pluck('name')->toArray();
        }

        return $this->roles()->with('permissions')->get()
            ->pluck('permissions')
            ->flatten()
            ->pluck('name')
            ->unique()
            ->toArray();
    }

    public function hasAnyRole(array $roles)
    {
        $userRoles = $this->getRoles();
        return !empty(array_intersect($roles, $userRoles));
    }

    public function hasPermissionTo($permission)
    {
        $permissions = $this->getPermissionsViaRoles();
        return in_array($permission, $permissions);
    }

    public function hasAnyPermission(array $permissions)
    {
        $userPermissions = $this->getPermissionsViaRoles();
        return !empty(array_intersect($permissions, $userPermissions));
    }

    public function hasAllPermissions(array $permissions)
    {
        $userPermissions = $this->getPermissionsViaRoles();
        return count(array_intersect($permissions, $userPermissions)) === count($permissions);
    }

    private function getRoles()
    {
        return $this->roles()->pluck('name')->toArray();
    }

    public function hasRole($roleName)
    {
        $roles = $this->getRoles();
        return in_array($roleName, $roles);
    }

    public function getAllPermissions()
    {
        $permissionNames = $this->getCachedPermissions();

        // Super admin has all permissions
         if($this->is_super_admin == 1){
            return PermissionList::pluck('name')->toArray();
        }

        // Get permission models for cached permission names
        return PermissionList::whereIn('name', $permissionNames)->get();
    }

}
