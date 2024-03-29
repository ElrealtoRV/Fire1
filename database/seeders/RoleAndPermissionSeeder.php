<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'Head']);
        $staffRole = Role::create(['name' => 'Maintenance Personnel']);
        $staffRole = Role::create(['name' => 'Staff']);
        $staffRole = Role::create(['name' => 'Student']);
        
    }
}
