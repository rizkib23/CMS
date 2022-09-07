<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        $listPermission = [];
        $superAdminPermission = [];
        $adminPermission = [];
        $guestPermission = [];
        foreach ($authorities as $label => $permissions) {
            foreach ($permissions as $permission) {
                $listPermission[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                // superAdmin
                $superAdminPermission[] = $permission;
                // admin
                if (in_array($label, ['manage_posts', 'manage_kategoris', 'manage_tags', 'manage_komentars'])) {
                    $adminPermission[] = $permission;
                }
                // user
                if (in_array($label, ['manage_komentars'])) {
                    $userPermission[] = $permission;
                }
            }
        }
        Permission::insert($listPermission);

        $superAdmin = Role::create([
            'name' => "superAdmin",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $admin = Role::create([
            'name' => "Admin",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $user = Role::create([
            'name' => "user",
            'guard_name' => 'web',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $superAdmin->givePermissionTo($superAdminPermission);
        $admin->givePermissionTo($adminPermission);
        $user->givePermissionTo($userPermission);
    }
}