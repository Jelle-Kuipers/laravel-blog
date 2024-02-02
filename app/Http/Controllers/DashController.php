<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class DashController extends Controller
{
    public function showAuthUser()
    {
        // Retrieve the authenticated user and permissions
        $user = Auth::user();
        $userModel = User::with('permission')->find($user->id);
        $userdata = new User();

        // Create a user data array for the front-end
        $userdata->id = $user->id;
        $userdata->name = $user->name;

        // Check if the user has an admin permission
        if ($userModel->hasPermissions('manage_others') || $userModel->hasPermissions('manage_topics')) {
            $userdata->hasAdminPermission = true;
        }

        // Show the dash user on the front-end
        return view('dash', ['userdata' => $userdata,]);
    }
}