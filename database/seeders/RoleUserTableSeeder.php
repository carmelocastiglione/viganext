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
        // Assign admin role to admin user
        $adminUser = User::where('email', 'admin@issvigano.org')->first();
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminUser && $adminRole) {
            $adminUser->roles()->attach($adminRole->id);
        }

        // Assign teacher role to teacher user
        $teacherUser = User::where('email', 'teacher@issvigano.org')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        if ($teacherUser && $teacherRole) {
            $teacherUser->roles()->attach($teacherRole->id);
        }

        // Assign student role to student user
        $studentUser = User::where('email', 'student@issvigano.org')->first();
        $studentRole = Role::where('name', 'student')->first();
        if ($studentUser && $studentRole) {
            $studentUser->roles()->attach($studentRole->id);
        }

        // Assign external role to external user
        $externalUser = User::where('email', 'external@issvigano.org')->first();
        $externalRole = Role::where('name', 'external')->first();
        if ($externalUser && $externalRole) {
            $externalUser->roles()->attach($externalRole->id);
        }
    }
}
