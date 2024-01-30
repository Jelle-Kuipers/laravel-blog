<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/feed', function () {
        return view('feed');
    })->name('feed');

    Route::get('/topic/{id}', function () {
        return view('topic');
    })->name('topic');

    Route::get('admin/users', 'App\Http\Controllers\AdminController@allowUserDashAccess')->name('admin@checkPermissions');

    Route::get('admin/userdash/delete/{id}', 'App\Http\Controllers\AdminController@deleteUser')->name('admin@deleteUser');

    Route::get('admin/user/{id}', 'App\Http\Controllers\AdminController@specifyUser')->name('admin@specifyUser');

    Route::post('admin/user/update/{id?}', 'App\Http\Controllers\AdminController@updateUser')->name('admin@updateUser');
});

// Requires manage_topics permission to access.
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'can:manage_topics'
])->group(function () {
    Route::get('admin/topics', function() {
        return view('topics');
    })->name('topics');

    Route::post('admin/topic/create', 'App\Http\Controllers\TopicController@createTopic')->name('topic@createTopic');

    Route::post('admin/topic/update', 'App\Http\Controllers\TopicController@updateTopic')->name('topic@updateTopic');

    Route::post('admin/topic/delete', 'App\Http\Controllers\TopicController@deleteTopic')->name('topic@deleteTopic');
});



Route::get('/test', 'App\Http\Controllers\FeedController@showFeedData');
