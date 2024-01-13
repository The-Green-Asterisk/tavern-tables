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
            'name' => 'Admin',
            'code' => 'AD'
        ]);
        \App\Models\Role::create([
            'name' => 'Tavern Keeper',
            'code' => 'TK'
        ]);
        \App\Models\Role::create([
            'name' => 'Game Master',
            'code' => 'GM'
        ]);
        \App\Models\Role::create([
            'name' => 'Player',
            'code' => 'PL'
        ]);
    }
}
