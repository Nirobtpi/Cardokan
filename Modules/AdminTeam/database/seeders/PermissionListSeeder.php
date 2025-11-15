<?php

namespace Modules\AdminTeam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AdminTeam\App\Models\PermissionList;

class PermissionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
           [
               'name' => 'admin_team',
               'display_name' => 'Admin Team',
               'module' => 'admin_team',
               'description' => 'Permission to view admin team members',
               'group' => 1,
               'parent_id' => null,
               'status' => 'active',
           ],
           [
               'name' => 'create_admin_team',
               'display_name' => 'Create Admin Team',
               'module' => 'admin_team',
               'description' => 'Permission to create new admin team members',
               'group' => false,
               'parent_id' => null,
               'status' => 'active',
           ],
           [
               'name' => 'edit_admin_team',
               'display_name' => 'Edit Admin Team',
               'module' => 'admin_team',
               'description' => 'Permission to edit existing admin team members',
               'group' => false,
               'parent_id' => null,
               'status' => 'active',
           ],
           [
               'name' => 'delete_admin_team',
               'display_name' => 'Delete Admin Team',
               'module' => 'admin_team',
               'description' => 'Permission to delete admin team members',
               'group' => false,
               'parent_id' => null,
               'status' => 'active',
            ],
            [
                'name'=>'dashboard_access',
                'display_name' => 'Dashboard Access',
                'module' => 'dashboard',
                'description' => 'Permission to access the dashboard',
                'group' => true,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'name'=>'manage_settings',
                'display_name' => 'Manage Settings',
                'module' => 'dashboard',
                'description' => 'Permission to manage application settings',
                'group' => false,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'name'=>'manage_blog',
                'display_name' => 'Manage Blog',
                'module' => 'blog',
                'description' => 'Permission to manage blog posts and categories',
                'group' => true,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'name'=>'create_blog_post',
                'display_name' => 'Create Blog Post',
                'module' => 'blog',
                'description' => 'Permission to create new blog posts',
                'group' => false,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'name'=>'edit_blog_post',
                'display_name' => 'Edit Blog Post',
                'module' => 'blog',
                'description' => 'Permission to edit existing blog posts',
                'group' => false,
                'parent_id' => null,
                'status' => 'active',
            ],
            [
                'name'=>'delete_blog_post',
                'display_name' => 'Delete Blog Post',
                'module' => 'blog',
                'description' => 'Permission to delete blog posts',
                'group' => false,
                'parent_id' => null,
                'status' => 'active',
            ],
        ];
        $groupIds=[];
        foreach ($permissions as $permission) {
            if($permission['group']){

                $createGropup=PermissionList::updateOrCreate(
                    ['name' => $permission['name']],
                    $permission
                );
                $groupIds[$permission['module']] = $createGropup->id;
            }
        }

        foreach ($permissions as $permission) {
            if(!$permission['group']){
                $parentGroup=$this->getParentGroupName($permission['module']);
                if($parentGroup && isset($groupIds[$parentGroup])){
                    $permission['parent_id']=$groupIds[$parentGroup];
                }
                PermissionList::updateOrCreate(
                    ['name' => $permission['name']],
                    $permission
                );
            }
        }
    }

    private function getParentGroupName($module){
        $maping = [
            'admin_team' => 'admin_team',
            'dashboard' => 'dashboard',
            'blog' => 'blog',
        ];

        return isset($maping[$module]) ? $maping[$module] : null;
    }


}

