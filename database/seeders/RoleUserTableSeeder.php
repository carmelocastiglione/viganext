<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@issvigano.org')->first();
        $adminRole = Role::where('name', 'admin')->first();

        if ($adminUser && $adminRole) {
            $adminUser->roles()->attach($adminRole->id);
        }
    }
}
