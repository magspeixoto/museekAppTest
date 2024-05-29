<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Role
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        // Create Permissions
        $manageUsersPermission = Permission::create(['name' => 'manage users']);
        $manageCategoriesPermission = Permission::create(['name' => 'manage categories']);
        $manageProductsPermission = Permission::create(['name' => 'manage products']);
        $manageBrandsPermission = Permission::create(['name' => 'manage brands']);

        // Set Permissions to Roles
        $adminRole->givePermissionTo([
            $manageUsersPermission,
            $manageCategoriesPermission,
            $manageProductsPermission,
        ]);
        $adminRole->revokePermissionTo([
            $manageBrandsPermission,
        ]);

        $editorRole->givePermissionTo([
            $manageCategoriesPermission,
            $manageProductsPermission,
            $manageBrandsPermission,
        ]);
    }
}
