<?php

namespace Database\Seeders;

use App\Models\LinkSkillProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkSkillProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LinkSkillProject::factory()->count(300)->create();
    }
}
