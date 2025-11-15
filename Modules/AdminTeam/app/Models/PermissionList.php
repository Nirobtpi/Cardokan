<?php

namespace Modules\AdminTeam\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\AdminTeam\Models\AdminRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AdminTeam\Database\Factories\PermissionListFactory;

class PermissionList extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    // protected static function newFactory(): PermissionListFactory
    // {
    //     // return PermissionListFactory::new();
    // }

    public function roles()
    {
        return $this->belongsToMany(
            AdminRole::class,
            'admin_role_permissions',
            'permission_id',
            'admin_role_id'
        );
    }

    public function children()
    {
        return $this->hasMany(
            PermissionList::class,
            'parent_id',
            'id'
        );
    }

    public function parent()
    {
        return $this->belongsTo(
            PermissionList::class,
            'parent_id',
            'id'
        );
    }
}
