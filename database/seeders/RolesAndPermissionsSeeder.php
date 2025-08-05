<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Permission::create(['name' => 'view users']);
    Permission::create(['name' => 'edit users']);
    
    $admin = Role::create(['name' => 'admin']);
    $admin->givePermissionTo(['view users', 'edit users']);
    
    $user = Role::create(['name' => 'user']);
    $user->givePermissionTo(['view users']);
}
}
