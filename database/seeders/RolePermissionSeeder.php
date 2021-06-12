<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create roles
        $superAdminRole = Role::create(['name' => 'super_admin']);
        $pourashavaAdminRole = Role::create(['name' => 'pourashava_admin']);
        $digitalCenterAdminRole = Role::create(['name' => 'digital_center_admin']);

        // permission
        $permissions = [
            [
                'group_name' => 'pourashava_admin',
                'permission' => [
                    'create_pourashava_admin',
                    'edit_pourashava_admin',
                    'view_pourashava_admin',
                    'delete_pourashava_admin',
                ],
            ],

            [
                'group_name' => 'user',
                'permission' => [
                    'create_user',
                    'edit_user',
                    'view_user',
                    'delete_user',
                ],
            ],

            [
                'group_name' => 'user_card',
                'permission' => [
                    'create_user_card',
                    'edit_user_card',
                    'view_user_card',
                    'delete_user_card',
                ],
            ],
        ];

        // create permissions
        foreach($permissions as $row) {
            $group_name = $row['group_name'] ?: '';
            foreach($row['permission'] as $singlePermission) {
                $permission = Permission::create(['group_name' => $group_name, 'name' => $singlePermission]);

                //super-admin permission
                if($group_name == 'pourashava_admin') {
                    $superAdminRole->givePermissionTo($permission);
                    $permission->assignRole($superAdminRole);
                } elseif($group_name == 'user') {
                    $pourashavaAdminRole->givePermissionTo($permission);
                    $permission->assignRole($pourashavaAdminRole);

                    $digitalCenterAdminRole->givePermissionTo($permission);
                    $permission->assignRole($digitalCenterAdminRole);

                    if($singlePermission == 'view_user') {
                        $superAdminRole->givePermissionTo($permission);
                        $permission->assignRole($superAdminRole);
                    }
                } elseif($group_name == 'user_card') {
                    $superAdminRole->givePermissionTo($permission);
                    $permission->assignRole($superAdminRole);
                }
            }
        }

        // get first user for super admin
        $superAdmin = \App\Models\Admin::find(1);
        // assign super-admin role
        $superAdmin->assignRole($superAdminRole);
    }
}
