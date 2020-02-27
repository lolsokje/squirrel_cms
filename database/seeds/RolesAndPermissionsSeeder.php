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
        $administratorRole = Role::create(['name' => 'Administrator']);
        $editorRole = Role::create(['name' => 'Editor']);

        $administrationPermission = Permission::create(['name' => 'manage']);
        $canEditPermission = Permission::create(['name' => 'edit articles']);

        $administratorRole->givePermissionTo($administrationPermission, $canEditPermission);
        $editorRole->givePermissionTo($canEditPermission);
    }
}
