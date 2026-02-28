<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add admin role for Mercatino libri usati project
        $mercatino = Project::where('name', 'Mercatino libri usati')->first();
        if ($mercatino) {
            ProjectRole::create([
                'project_id' => $mercatino->id,
                'name' => 'admin',
                'description' => 'Amministratore del progetto',
            ]);
        }
    }
}
