<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return view('projects.index');
    } else {
        return view('home.home');
    }
})->name('home');

Route::middleware('auth')->group(function () {
    //User profile
    Route::get('profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [UserController::class, 'update'])->name('profile.update');
    Route::delete('education/{id}', [EducationController::class, 'destroy'])->name('education.destroy');
    Route::delete('experience/{id}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
    //Portfolio
    Route::get('portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('portfolio/{id}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('portfolio/{id}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('portfolio/{id}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    //Post
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    //Comment
    Route::delete('comment/{id}',[CommentController::class, 'destroy'])->name('comment.destroy');
});
//Profile
Route::get('profile/{username}-{userid}', [ProfileController::class, 'index'])->name('profile.index');
//Portfolio
Route::get('portfolio/{username}-{userid}', [PortfolioController::class, 'index'])->name('portfolio.index');
//Post
Route::get('posts/{username}-{userid}',[PostController::class, 'user_index'])->name('post.user.index');
Route::get('post/{id}',[PostController::class, 'show'])->name('post.show');
require __DIR__ . '/auth.php';
