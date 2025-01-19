<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Auth\LoginController;

// Main home route
Route::get('/mainhome', function () {
    return view('mainhome');
})->name('mainhome'); // Named route: 'mainhome'

// Login home route
Route::get('/loginhome', function () {
    return view('loginhome');
})->name('loginhome'); // Named route: 'loginhome'

// Register route
Route::get('/register', function () {
    return view('register');
})->name('register');

// Register user route
Route::post('/register', [UserController::class, 'register'])->name('user.register');

// Login user route
Route::post('/login', [LoginController::class, 'login'])->name('login');

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
})->name('sellerpage'); // Named route: 'sellerpage'

// Create Race route
Route::get('/createrace', function () {
    return view('createrace');
})->name('createrace');

// Create Grandstand route
Route::get('/creategrandstand', function () {
    return view('creategrandstand');
})->name('creategrandstand');