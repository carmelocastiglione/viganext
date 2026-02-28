<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectRoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add admin and external users as admins of Mercatino libri usati project
        $mercatino = Project::where('name', 'Mercatino libri usati')->first();
        if ($mercatino) {
            $adminRole = ProjectRole::where('project_id', $mercatino->id)
                ->where('name', 'admin')
                ->first();

            if ($adminRole) {
                $adminUser = User::where('email', 'admin@issvigano.org')->first();
                $externalUser = User::where('email', 'external@issvigano.org')->first();

                if ($adminUser) {
                    $adminRole->users()->attach($adminUser->id);
                }

                if ($externalUser) {
                    $adminRole->users()->attach($externalUser->id);
                }
            }
        }
    }
}
