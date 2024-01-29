<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $muted = fake()->boolean();

        return [
            'title' => fake()->word(1),
            'create_update_post' => fake()->boolean(),
            'create_update_reply' => $muted,
            'delete_post' => fake()->boolean(),
            'delete_reply' => $muted,
            'delete_others_reply' => fake()->boolean(),
            'delete_others_post' => fake()->boolean(),
            'manage_topics' => fake()->boolean(),
            'manage_others' => fake()->boolean(),
        ];
    }
}
