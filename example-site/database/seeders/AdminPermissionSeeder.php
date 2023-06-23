<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermissions = [
            "create role",
            "read role",
            "update role",
            "delete role"
        ];

        $role = Role::findByName('admin');

        foreach($adminPermissions as $permission){
            Permission::create(['name' => $permission])
            ->assignRole($role);
        }

    }
}
