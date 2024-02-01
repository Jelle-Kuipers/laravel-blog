<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'topic_id' => fake()->numberBetween(1, 10),
            'user_id' => fake()->numberBetween(1, 10),
            'title' => fake()->sentence(1),
            'description' => fake()->sentence(2),
            'thumbnail_path' => 'https://source.unsplash.com/random/800x600',
            'content' => fake()->sentence(3),
        ];
    }
}
