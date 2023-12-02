<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Permission;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::factory()
            ->has(Permission::factory()->count(1))
            ->count(50)
            ->create();

        User::factory()
            ->has(
                Permission::factory()
                    ->state([
                        'create_update_post' => 1,
                        'create_update_reply' => 1,
                        'delete_post' => 1,
                        'delete_reply' => 1,
                        'delete_others_reply' => 1,
                        'delete_others_post' => 1,
                        'manage_others' => 1,
                    ])
                    ->count(1)
            )
            ->state([
                'name' => 'admin',
                'email' => 'Admin@noreply.com',
                'password' => bcrypt('admin'),
            ])
            ->count(1)
            ->create();
    }
}
