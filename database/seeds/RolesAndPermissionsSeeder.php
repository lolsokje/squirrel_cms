<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super Admin role
        Role::create(['name' => config('permission.consts.super_admin_name')]);

        $administratorRole = Role::create(['name' => 'Administrator']);
        $editorRole = Role::create(['name' => 'Editor']);

        $administrationPermission = Permission::create([
            'name' => 'manage',
            'description' => 'Allows user to manage site-related settings']);

        $canEditPermission = Permission::create([
            'name' => 'edit articles',
            'description' => 'Allows user to create, edit, publish and delete articles'
        ]);

        $administratorRole->givePermissionTo($administrationPermission, $canEditPermission);
        $editorRole->givePermissionTo($canEditPermission);
    }
}
