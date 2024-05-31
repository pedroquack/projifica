<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    if(auth()->check()){
        return view('projects.index');
    }else{
        return view('home.home');
    }
})->name('home');

Route::get('profile/{name}-{id}', [ProfileController::class, 'index'])->name('profile.index');
Route::delete('education/{id}', [ProfileController::class, 'educationDestroy'])->name('education.destroy');
Route::delete('experience/', [ProfileController::class, 'experienceDestroy'])->name('experience.destroy');
require __DIR__.'/auth.php';
