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
            return view('userdash', ['users' => $users], ['specifiedUser' => null]);
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

    public function specifyUser($id,) {
        $specifiedUser = User::with('permission')->find($id);
        return view('userdash', ['specifiedUser' => $specifiedUser]);
    }

    public function updateUser($id = null) {
        // Check if a user is specified

        if ($id != null) {
            // If so, check if the user is trying to update themselves
            if (Auth::user()->id == $id) {
                // If so, abort with a 403 error
                abort(403, 'You are not able to update yourself.');
            }
            // If not, find the specified user
            $user = User::find($id);
            $permission = Permission::where('user_id', $user->id)->first();
        } else {
            // If not, create a new user
            $user = new User();
            // Create a new permission for the user
            $permission = new Permission();

            echo("creating");
        }

        // Update the user's information
        $user->name = request('name');
        $user->email = request('email');
        
        // If there is no password set,
        if ( request('password') == null ) {
            if ($id == null) {
                // if the user is new, abort with a 403 error. A password is required to be set.
                abort(403, 'Password is required to be set.');
            }
            // Otherwise, set the password to the same password
            $user->password = $user->password;
        } else {
            // Otherwise, set the password to the new password
            $user->password = bcrypt(request('password'));
        }

        $user->save();

        // And permissons
        $permission->user_id = $user->id;
        $permission->title = request('title');
        $permission->create_update_post = (request('create_update_post') === 'on') ? 1 : 0;
        $permission->delete_post = (request('delete_post') === 'on') ? 1 : 0;
        $permission->create_update_reply = (request('create_update_reply') === 'on') ? 1 : 0;
        $permission->delete_reply = (request('delete_reply') === 'on') ? 1 : 0;
        $permission->delete_others_reply = (request('delete_others_reply') === 'on') ? 1 : 0;
        $permission->delete_others_post = (request('delete_others_post') === 'on') ? 1 : 0;
        $permission->manage_others = (request('manage_others') === 'on') ? 1 : 0;
        $permission->save();

        return redirect()->back();
    }
}
