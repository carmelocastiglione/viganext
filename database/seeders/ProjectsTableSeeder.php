<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@issvigano.org')->first();

        if ($adminUser) {
            Project::create([
                'name' => 'Viga Special Week',
                'description' => 'Viga Special Week',
                'user_id' => $adminUser->id,
            ]);

            Project::create([
                'name' => 'CicLab',
                'description' => 'CicLab',
                'user_id' => $adminUser->id,
            ]);

            Project::create([
                'name' => 'Mercatino libri usati',
                'description' => 'Mercatino libri usati',
                'user_id' => $adminUser->id,
            ]);
        }
    }
}
