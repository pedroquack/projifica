<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = random_int(0,1);
        if($random == 0){
            $image = fake()->imageUrl();
        }else{
            $image = null;
        };

        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'image' => $image,
            'user_id' => random_int(1,100),
            'created_at' => fake()->dateTimeThisDecade($max='now'),
        ];
    }
}
