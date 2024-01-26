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
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/feed', function () {
        return view('feed');
    })->name('feed');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin/userdash', 'App\Http\Controllers\AdminController@allowUserDashAccess')->name('admin@checkPermissions');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin/userdash/delete/{id}', 'App\Http\Controllers\AdminController@deleteUser')->name('admin@deleteUser');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin/userdash/selected/{id}', 'App\Http\Controllers\AdminController@specifyUser')->name('admin@specifyUser');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin/userdash/update/{id}', 'App\Http\Controllers\AdminController@updateUser')->name('admin@updateUser');
});

Route::get('/test', 'App\Http\Controllers\FeedController@showFeedData');