<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\User;

class UserController extends Controller {

    // Create
    public function createUser() {
        $this->authorize('create', User::class);

        // Check if the request has all required fields
        if (
            empty(request()->all()) ||
            !request('name') || !request('email') || !request('password') || !request('title')
        ) {
            abort(400, 'Missing required fields.');
        }

        // Create the user
        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->save();

        // Create the permission
        $permission = new Permission();
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

        // Redirect to the specified user
        return redirect(route('user@specifyUser', $user->id));
    }

    // Read: list of all users
    public function viewAllUsers() {
        $this->authorize('viewAny', User::class);

        // Get all users, in a paginated form
        $users = User::paginate(10);
        return view('users', ['users' => $users, 'specifiedUser' => null]);
    }

    // Read: a specific user
    public function specifyUser($id = null) {
        $this->authorize('viewAny', User::class);

        $specifiedUser = User::with('permission')->find($id);
        return view('users', ['specifiedUser' => $specifiedUser]);
    }

    // Update
    public function updateUser($id) {
        $this->authorize('update', User::class);

        // Check request params
        if (empty(request()->all())) {
            abort(400, 'Missing required fields.');
        }

        // Check if the user is trying to update themselves
        if (Auth::user()->id == $id) {
            // If so, abort with a 403 error
            abort(403, 'You are not able to update yourself.');
        }

        // If not, find the specified user
        $user = User::find($id);

        // Filter out empty and unnecessary request parameters
        $data = array_filter(request()->except('_token', 'id'), function ($value) { // We filter out the ID, since this should not be updated
            return $value !== null && $value !== '';
        });

        // Update the user
        $user->update($data);

        // Check and set permissions to 0 if unset, and 1 if set
        $permissions = [
            'create_update_post',
            'delete_post',
            'create_update_reply',
            'delete_reply',
            'delete_others_reply',
            'delete_others_post',
            'manage_topics',
            'manage_others'
        ];
        foreach ($permissions as $permission) {
            if (!isset($data[$permission])) {
                $data[$permission] = 0;
            } else {
                $data[$permission] = 1;
            }
        }

        // Update the permission
        $permission = Permission::where('user_id', $user->id)->first(); // Retrieve the permission object
        $permission->update($data);

        // Return to the specified user
        return redirect(route('user@specifyUser', $user->id));
    }

    // Delete
    public function deleteUser($id) {
        $this->authorize('delete', User::class);

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
}
