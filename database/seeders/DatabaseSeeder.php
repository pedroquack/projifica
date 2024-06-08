<?php

namespace Database\Seeders;

use App\Models\LinkSkillProject;
use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Pedro Volpatto',
            'email' => 'pedrovolpattocosta@gmail.com',
            'password' => bcrypt('coxinha123'),
            'description' => fake()->realText(),
            'phone' => '(41) 99742-1004',
            'image' => fake()->imageUrl(),
        ]);

        $this->call(SkillSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(LinkSkillProjectSeeder::class);
        $this->call(PostSeeder::class);
    }
}
