<?php

namespace Modules\AdminTeam\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Modules\AdminTeam\App\Models\PermissionList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AdminTeam\Database\Factories\AdminRoleFactory;

class AdminRole extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): AdminRoleFactory
    // {
    //     // return AdminRoleFactory::new();
    // }

    public function permissions()
    {
        return $this->belongsToMany(
            PermissionList::class,
            'admin_role_permissions',
            'admin_role_id',
            'permission_id'
        );
    }

    public function admins()
    {
        return $this->belongsToMany(
            Admin::class,
            'admin_role',
            'admin_role_id',
            'admin_id'
        );
    }

}
