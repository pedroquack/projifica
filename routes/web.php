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
require __DIR__.'/auth.php';
