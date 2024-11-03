<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'posts' => auth()->user()->posts,
        'followers' => auth()->user()->followers,
        'following' => auth()->user()->following
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get("/users/follow/{id}", [FollowController::class, 'follow']);
    Route::get("/users/unfollow/{id}", [FollowController::class, 'unfollow']);
    Route::get("/users/following/{id}", [FollowController::class, 'isFollowing']);

    Route::get('/posts/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/posts', [BlogController::class, 'store'])->name('blog.store');
    Route::post('/posts/{post}', [BlogController::class, 'show'])->name('blog.show');
});

require __DIR__.'/auth.php';
