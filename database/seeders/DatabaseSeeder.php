<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ProjectsTableSeeder;
use Database\Seeders\RoleUserTableSeeder;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ProjectRolesTableSeeder;
use Database\Seeders\ProjectRoleUserTableSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            ProjectsTableSeeder::class,
            ProjectRolesTableSeeder::class,
            ProjectRoleUserTableSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
