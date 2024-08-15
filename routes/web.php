<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('project.index');
    }
    return view('home.home');
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
    //Project
    Route::resource('project', ProjectController::class);
    Route::get('user/{id}/projects', [ProjectController::class, 'user_projects'])->name('user.projects');
    Route::get('user/{id}/projects/joined', [ProjectController::class, 'project_joined'])->name('project.joined');
    Route::get('projects/most-popular', [ProjectController::class, 'most_popular'])->name('project.popular');
    Route::get('projects/less-popular', [ProjectController::class, 'less_popular'])->name('project.unpopular');
    Route::get('projects/search', [ProjectController::class, 'search'])->name('project.search');

    //Report
    Route::post('report/{type}', [ReportController::class, 'store'])->name('report.store');

    Route::middleware('isAdmin')->group(function (){
        Route::get('dashboard/chart', [AdminController::class ,'dashboard'])->name('admin.dashboard');
        Route::get('dashboard/users', [AdminController::class ,'users'])->name('admin.users');
        Route::get('dashboard/projects', [AdminController::class ,'projects'])->name('admin.projects');
        Route::get('dashboard/posts', [AdminController::class ,'posts'])->name('admin.posts');
        Route::get('dashboard/reports', [AdminController::class ,'reports'])->name('admin.reports');
        Route::get('dashboard/user/{id}', [AdminController::class ,'user_destroy'])->name('admin.user.destroy');
        Route::get('dashboard/project/{id}', [AdminController::class ,'project_destroy'])->name('admin.project.destroy');
        Route::get('dashboard/post/{id}', [AdminController::class ,'post_destroy'])->name('admin.post.destroy');
        Route::get('dashboard/comment/{id}', [AdminController::class ,'comment_destroy'])->name('admin.comment.destroy');
        Route::get('dashboard/skills/', [SkillController::class ,'index'])->name('admin.skills');
        Route::delete('dashboard/skills/{id}', [SkillController::class ,'destroy'])->name('admin.skills.destroy');

    });
});
//Profile
Route::get('profile/{userid}', [ProfileController::class, 'index'])->name('profile.index');
//Portfolio
Route::get('portfolio/{userid}', [PortfolioController::class, 'index'])->name('portfolio.index');
//Post
Route::get('post/{id}',[PostController::class, 'show'])->name('post.show');
Route::get('posts',[PostController::class, 'index'])->name('post.index');
Route::get('posts/oldest',[PostController::class, 'oldest'])->name('post.oldest');
Route::get('posts/more-comments',[PostController::class, 'more_comments'])->name('post.more.comments');
Route::get('posts/less-comments',[PostController::class, 'less_comments'])->name('post.less.comments');
Route::get('posts/{userid}',[PostController::class, 'user_index'])->name('post.user.index');

//User search

Route::get('users',[UserController::class, 'index'])->name('user.index');
Route::get('users/more-posts',[UserController::class, 'more_posts'])->name('user.more.posts');
Route::get('users/bigger-portfolio',[UserController::class, 'bigger_portfolio'])->name('user.bigger.portfolio');
require __DIR__ . '/auth.php';
