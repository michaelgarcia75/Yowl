<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityUser>
 */
class CommunityUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(array(11, 21, 31, 41, 51, 61, 71, 81, 91)),
            'community_id' => $this->faker->randomElement(array(11, 21, 31, 41, 51, 61, 71, 81, 91)),
        ];
    }
}
