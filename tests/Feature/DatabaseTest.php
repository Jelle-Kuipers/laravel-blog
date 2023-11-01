<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\User;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    //Test if fresh migrations are successful
    public function test_fresh_migrations_migrate_successfully(): void
    {
        Artisan::call('migrate:fresh');

        //Ensure database was fully made, with the expected amount of entries
        $this->assertDatabaseCount('users', 0);
        $this->assertDatabaseCount('permissions', 0);
        $this->assertDatabaseCount('topics', 0);
        $this->assertDatabaseCount('posts', 0);
        $this->assertDatabaseCount('comments', 0);
        $this->assertDatabaseCount('password_reset_tokens', 0);
        $this->assertDatabaseCount('failed_jobs', 0);
        $this->assertDatabaseCount('password_reset_tokens', 0);
        $this->assertDatabaseCount('migrations', 8);
    }

    //Test if seeder makes the expected amount of entries
    public function test_seeders_seed_successfully(): void {
        
        Artisan::call('db:seed');

        //Ensure amount of entries is as expected.
        $this->assertDatabaseCount('users', 50);
        $this->assertDatabaseCount('permissions', 50);
        $this->assertDatabaseCount('topics', 5);
        $this->assertDatabaseCount('posts', 10);
        $this->assertDatabaseCount('comments', 30);
        $this->assertDatabaseCount('password_reset_tokens', 0);
        $this->assertDatabaseCount('failed_jobs', 0);
        $this->assertDatabaseCount('password_reset_tokens', 0);
        $this->assertDatabaseCount('migrations', 8);
    }
}
