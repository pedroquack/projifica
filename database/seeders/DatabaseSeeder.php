<?php

namespace Database\Seeders;

use App\Models\LinkSkillProject;
use App\Models\Portfolio;
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
            'role' => 'adm',
            'phone' => '(41) 99742-1004',
            'image' => fake()->imageUrl(),
        ]);

        Project::create([
            'title' => 'Criar um site de gerenciamento de tarefas',
            'description' => fake()->paragraph(),
            'slots' => 4,
            'expiration' => fake()->dateTimeBetween($startDate = 'now',$endDate = "+2 years"),
            'modality' => 'Híbrido',
            'user_id' => 1,
        ]);

        $this->call(SkillSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(LinkSkillProjectSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(LinkUserProjectSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(PortfolioSeeder::class);
        $this->call(EducationSeeder::class);
        $this->call(ExperienceSeeder::class);
    }
}
