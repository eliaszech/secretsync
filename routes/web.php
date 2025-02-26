<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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



Route::middleware(['auth', 'verified'])->group(function() {
    Volt::route('/', 'pages.dashboard')->name('dashboard');

    Volt::route('/posts/create', 'pages.posts.post-create')->name('post.create');
    Volt::route('/posts/{post}', 'pages.posts.post-view')->name('post.view');
    Volt::route('/posts', 'pages.posts.posts')->name('posts');

    Volt::route('/shoutbox/{type}', 'pages.shoutbox')->name('shoutbox');

    Route::view('profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
