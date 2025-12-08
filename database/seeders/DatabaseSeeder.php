<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'SuperAdmin']);

        $superAdmin = User::firstOrCreate(
            ['username' => 'SuperAdmin'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
            ]
        );

        if (!$superAdmin->hasRole('SuperAdmin')) {
            $superAdmin->assignRole($superAdminRole);
        }
    }
}
