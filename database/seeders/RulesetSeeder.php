<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'name' => 'D&D 5e',
            'code' => 'DD5'
        ]);
        \App\Models\Role::create([
            'name' => 'Traveler',
            'code' => 'TV'
        ]);
        \App\Models\Role::create([
            'name' => 'D&D 3.5e',
            'code' => 'DD3'
        ]);
        \App\Models\Role::create([
            'name' => 'Hero System',
            'code' => 'HS'
        ]);
    }
}
