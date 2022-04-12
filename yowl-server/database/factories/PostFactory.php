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
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->text(15),
            'content' => $this->faker->text(30),
            'media' => $this->faker->image(),
            'user_id' => $this->faker->numberBetween(1, 10),
            'community_id' => $this->faker->numberBetween(1, 10),
            'upvotes' => 0,
            'is_reported' => 0,
        ];
    }
}
