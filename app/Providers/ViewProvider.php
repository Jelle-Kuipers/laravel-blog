<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        // Using class based composers...
        View::composer(
            ['layouts.header', 'dash', 'posts','singlepost', 'topics'], // replace with your header view
            function ($view) {
                // Get the authenticated user and their permissions 
                $user = Auth::user()->load('permission');

                // Check if the user has an admin permission
                if ($user->hasPermissions('manage_others') || $user->hasPermissions('manage_topics')) {
                    $user->hasAdminPermission = true;
                }

                // return the view with the user data
                $view->with('user', $user);
            }
        );
    }
}
