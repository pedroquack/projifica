<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LinkSkillProject>
 */
class LinkSkillProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'skill_id' => random_int(1,100),
            'project_id' => random_int(1,100),
        ];
    }
}
