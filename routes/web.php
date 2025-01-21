<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RaceController;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\LoginController;


// Main home route
Route::get('/', function () {
    return view('mainhome');
});

// Login home route
Route::get('/login', function () {
    return view('loginhome');
})->name('login');

// Register view route
Route::get('/register', function () {
    return view('register');
})->name('register');

// Register user route
Route::post('/register', [UserController::class, 'register'])->name('user.register');

// Login user route
Route::post('/login', [LoginController::class, 'login'])->name('user.login');

// User page route
Route::get('/userpage', function () {
    return view('userpage');
})->name('userpage');

// Route for viewing a specific race
Route::get('/viewrace/{id}', function ($id) {
    return view('viewrace', ['id' => $id]);
})->name('viewrace');

// Route for viewing seats of a specific grandstand
Route::get('/grandstand/{id}/seats', function ($id) {
    return view('seatselection', ['id' => $id]);
})->name('grandstand.seats');

// Seller page route
Route::get('/sellerpage', function () {
    return view('sellerpage');
})->name('sellerpage');
Route::get('/race/new', [RaceController::class, 'create'])->name('race.new');
Route::post('/race', [RaceController::class, 'store'])->name('race.store');
// Create Grandstand route
Route::get('/creategrandstand', function () {
    return view('creategrandstand');
})->name('creategrandstand');