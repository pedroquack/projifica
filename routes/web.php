<?php

use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    if(auth()->check()){
        return view('projects.index');
    }else{
        return view('home.home');
    }
})->name('home');

Route::get('profile/{name}-{id}', [ProfileController::class, 'index'])->name('profile.index');
Route::get('profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('profile/{id}', [UserController::class, 'update'])->name('profile.update');
Route::delete('education/{id}', [EducationController::class, 'destroy'])->name('education.destroy');
Route::delete('experience/{id}', [ExperienceController::class, 'destroy'])->name('experience.destroy');
require __DIR__.'/auth.php';
