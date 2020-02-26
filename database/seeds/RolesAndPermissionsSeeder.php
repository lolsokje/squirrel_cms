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
        $administrationPermission = Permission::create(['name' => 'manage']);
        $administrationPermission->assignRole($administratorRole);

        $editorRole = Role::create(['name' => 'Editor']);
        $canEditPermission = Permission::create(['name' => 'edit articles']);

        $canEditPermission->assignRole($editorRole);
    }
}
