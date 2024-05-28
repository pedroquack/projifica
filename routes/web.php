<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(auth()->check()){
        return view('projects.index');
    }else{
        return view('home.home'); 
    }
})->name('home');

require __DIR__.'/auth.php';
