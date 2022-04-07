<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->company(),
            'description' => $this->faker->catchPhrase(),
            'image' => $this->faker->image(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'is_reported' => 0,
        ];
    }
}
