<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login screen, anyone can access
Route::get('/', function () {
    return view('welcome');
});

// Anyone that is logged in can access
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/feed', function () {
        return view('feed');
    })->name('feed');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dash');
    })->name('dash@show');

    // Posts and voting
    Route::get('/posts', 'App\Http\Controllers\PostController@readPosts')->name('post@readPosts');
    Route::get('/post/{id}/vote', 'App\Http\Controllers\PostController@voteOnPost')->name('post@VoteOnPost');
    Route::get('/post/{id}/unvote', 'App\Http\Controllers\PostController@removeVoteOnPost')->name('post@UnvoteOnPost');

    // User profile

    // Topics
    Route::get('/topics', function () {
        return view('topics');
    })->name('topic@seeTopics');
});

// Requires manage_users permission to access.
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:viewAny,App\Models\User',
])->group(function () {

    Route::get('admin/users', 'App\Http\Controllers\UserController@viewAllUsers')->name('user@viewAllUsers');

    Route::get('admin/user/{id}', 'App\Http\Controllers\UserController@specifyUser')->name('user@specifyUser');

    Route::post('admin/user/create', 'App\Http\Controllers\UserController@createUser')->name('user@createUser');

    Route::post('admin/user/update/{id}', 'App\Http\Controllers\UserController@updateUser')->name('user@updateUser');

    Route::post('admin/user/delete/{id}', 'App\Http\Controllers\UserController@deleteUser')->name('user@deleteUser');
});

// Requires manage_topics permission to access.
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:viewAny,App\Models\Topic',
])->group(function () {

    Route::post('admin/topic/create', 'App\Http\Controllers\TopicController@createTopic')->name('topic@createTopic');

    Route::post('admin/topic/update', 'App\Http\Controllers\TopicController@updateTopic')->name('topic@updateTopic');

    Route::post('admin/topic/delete', 'App\Http\Controllers\TopicController@deleteTopic')->name('topic@deleteTopic');
});

// Requires create_update_posts / delete_posts permission and ownership OR delete_others_post permission.
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:viewAny,App\Models\Post',
])->group(function () {

    Route::post('post/create', 'App\Http\Controllers\PostController@createPost')->name('post@createPost');

    Route::post('post/update', 'App\Http\Controllers\PostController@updatePost')->name('post@updatePost');

    Route::post('post/delete', 'App\Http\Controllers\PostController@deletePost')->name('post@deletePost');
});

// Only someone who has an admin permission can visist this panel
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:isAdmin,App\Models\User',
])->group(function () {

    Route::get('admin/panel', function () {
        return view('admindash');
    })->name('admin@panel');
});
