<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin', 'description' => 'Amministratori del sistema']);
        Role::create(['name' => 'teacher', 'description' => 'Insegnanti']);
        Role::create(['name' => 'student', 'description' => 'Studenti']);
        Role::create(['name' => 'external', 'description' => 'Utenti esterni']);
    }
}
