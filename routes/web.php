<?php

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Models\User;


// Main home route
Route::get('/mainhome', function () {
    return view('mainhome');
})->name('mainhome'); // Named route: 'mainhome'

// Login home route
Route::get('/loginhome', function () {
    return view('loginhome');
})->name('loginhome'); // Named route: 'loginhome'

