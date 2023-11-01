<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Topic;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class SiteSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Topic::factory()
            ->count(5)
            ->has(
                Post::factory()
                    ->count(2)
                    ->state(
                        new Sequence(
                            fn () => ['user_id' => User::all()->random()]
                        )
                    )
                    ->has(
                        Comment::factory()
                            ->count(3)
                            ->state(
                                new Sequence(
                                    fn () => ['user_id' => User::all()->random()]
                                )
                            )
                    )
            )
            ->create();
    }
}
