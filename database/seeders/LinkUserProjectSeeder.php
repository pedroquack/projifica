<?php

namespace Database\Seeders;

use App\Models\LinkUserProject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinkUserProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LinkUserProject::factory()->count(150)->create();
    }
}
