<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Policies\TopicPolicy;
use App\Policies\UserPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Topic' => 'App\Policies\TopicPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Post' => 'App\Policies\PostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('manage_topics', [TopicPolicy::class, 'manage_topics']);
        Gate::define('CRUD_post', [PostPolicy::class, 'CRUD_post']);
        Gate::define('manage_others', [UserPolicy::class, 'manage_others']);
    }
}
