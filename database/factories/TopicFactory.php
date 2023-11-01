<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'title' => fake()->unique()->sentence(1),
            'description' => fake()->sentence(3),
            'thumbnail_path' => 'https://source.unsplash.com/random/800x600',
        ];
    }
}
