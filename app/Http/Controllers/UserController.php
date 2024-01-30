<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\User;

class UserController extends Controller {

    protected $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    // Create
    public function createUser() {
        $this->authorize('create', $this->user);


    }

    // Read
    public function viewAllUsers() {
        $this->authorize('viewAny', $this->user);

        $users = User::paginate(10);
        return view('userdash', ['users' => $users]);
    }

    // Update
    public function updateUser($id) {
        $this->authorize('update', $this->user);
        
        // Check request params
        if (empty(request()->all())) {
            abort(400, 'Missing required fields.');
        }

        // Check if a user is specified
        if (Auth::user()->id == $id) {
            // If so, abort with a 403 error
            abort(403, 'You are not able to update yourself.');
        }

        // If not, find the specified user
        $user = User::find($id);
        $permission = Permission::where('user_id', $user->id)->first();

        // Update the user's information
        $user->name = request('name');
        $user->email = request('email');

        // If there is no password set,
        if (request('password') == null) {
            // Use old password
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
        $permission->manage_topics = (request('manage_topics') === 'on') ? 1 : 0;
        $permission->manage_others = (request('manage_others') === 'on') ? 1 : 0;
        $permission->save();

        return redirect()->back();
    }

    // Delete
    public function deleteUser($id) {


        // Check if the user is trying to delete themselves
        if ($this->user->id == $id) {
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
        $this->authorize('viewAny', $this->user);

        $specifiedUser = User::with('permission')->find($id);
        return view('userdash', ['specifiedUser' => $specifiedUser]);
    }
}
