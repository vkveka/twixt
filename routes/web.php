<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::resource('/users', App\Http\Controllers\UserController::class)->except('index', 'create', 'store');

Route::resource('/comments', App\Http\Controllers\CommentController::class);

Route::resource('/posts', App\Http\Controllers\PostController::class)->except('index', 'create', 'show');

// Route::get('/posts/search', [App\Http\Controllers\PostController::class, 'search'])->name('posts.search');

Route::get('/users/moncompte/{user}', [App\Http\Controllers\UserController::class, 'monCompte'])->name('users.moncompte');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('guest');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home')->middleware('auth');

Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search');