<?php

namespace Database\Factories;

use App\Models\LinkSkillProject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       $modalities = [
        'Presencial',
        'Remoto',
        'Híbrido'
       ];

        return [
            'title' => fake()->name(),
            'description' => fake()->realText(),
            'modality' => $modalities[rand(0,2)],
            'expiration' => fake()->dateTimeBetween($startDate = 'now',$endDate = "+2 years",$timezone = null),
            'slots' => random_int(1,100),
            'user_id' => User::factory(),
        ];
    }
}
