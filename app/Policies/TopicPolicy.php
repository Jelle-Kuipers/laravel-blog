<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    use HandlesAuthorization;
    
    public function manage_topics(User $user)
    {
        if ($user->hasPermissions('manage_topics')) {
            return true;
        } 
        return false;
    }
}
