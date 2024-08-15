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
