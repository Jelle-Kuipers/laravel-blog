<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\User;

class AdminController extends Controller {
    private function checkPermissions() {
        $permissions = Permission::get()->where('id', Auth::user()->id)->first();

        if ($permissions->manage_others === True) {
            return true;
        } else {
            return false;
        }
    }

    public function allowUserDashAccess($specifiedUser = null) {
        if ($this->checkPermissions()) {
            $users = User::paginate(10);
            if(isset($specifiedUser)) {
                return view('userdash', ['users' => $users, 'specifiedUser' => $specifiedUser]);
            }
            return view('userdash', ['users' => $users]);
        } else {
            abort(404, 'Page not found.');
        };
    }

    public function deleteUser($id) {
        // Check if the user is trying to delete themselves
        if (Auth::user()->id == $id) {
            // If so, abort with a 403 error
            abort(403, 'You are not able to delete yourself.');
        } else {
            // Delete the specificied user
            $user = User::find($id);
            $user->delete();
            return redirect()->back();
        }
    }

    public function specifyUser($id) {
        $specifiedUser = User::with('permission')->find($id);
        return $this->allowUserDashAccess($specifiedUser);
    }

    public function updateUser($id){}
}
