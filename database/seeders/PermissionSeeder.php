<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web']
        );

        $viewDashboard = Permission::firstOrCreate(
            ['name' => 'view-dashboard', 'guard_name' => 'web']
        );

        $adminRole->givePermissionTo($viewDashboard);

        $user = User::where('email', 'admin@example.com')->first();
        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
