<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage product',
            'manage stock',
            'manage report',
            'manage category',
            'manage user',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $cashierRole = Role::firstOrCreate([
            'name' => 'cashier',
        ]);

        $cashierRolePermissions = [
            'manage product',
            'manage stock',
            'manage report',
            'manage category',
        ];

        $cashierRole->syncPermissions($cashierRolePermissions);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
        ]);

        $adminRole->syncPermissions($permissions);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole($adminRole);
    }
}
