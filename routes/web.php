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

    Route::get('admin/userdash', 'App\Http\Controllers\AdminController@allowUserDashAccess')->name('admin@checkPermissions');

    Route::get('admin/userdash/delete/{id}', 'App\Http\Controllers\AdminController@deleteUser')->name('admin@deleteUser');

    Route::get('admin/userdash/{id}', 'App\Http\Controllers\AdminController@specifyUser')->name('admin@specifyUser');

    Route::post('admin/userdash/update/{id?}', 'App\Http\Controllers\AdminController@updateUser')->name('admin@updateUser');

    Route::get('admin/topicdash', 'App\Http\Controllers\TopicController@allowTopicDashAccess')->name('topic@allowTopicDashAccess');

    Route::post('admin/topicdash/create', 'App\Http\Controllers\TopicController@createTopic')->name('topic@createTopic');
});
Route::get('/test', 'App\Http\Controllers\FeedController@showFeedData');