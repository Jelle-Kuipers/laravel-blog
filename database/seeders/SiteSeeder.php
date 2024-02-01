<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Topic;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\PostVote;

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

        for ($i = 0; $i < 50; $i++) {
            do {
                $userId = User::all()->random()->id;
                $postId = Post::all()->random()->id;
            } while (PostVote::where('user_id', $userId)->where('post_id', $postId)->exists());

            PostVote::factory()->create([
                'user_id' => $userId,
                'post_id' => $postId,
            ]);
        }
    }
}
