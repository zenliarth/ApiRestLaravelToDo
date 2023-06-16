<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Team',
            'email' => 'team@team.com',
            'password' => bcrypt('password'),
        ]);

        Task::factory(10)->create([
            'created_by' => $user->id,
        ]);
    }
}
