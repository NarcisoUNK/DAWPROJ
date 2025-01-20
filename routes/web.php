<?php

use Illuminate\Support\Facades\Route;

// Main home route
Route::get('/', function () {
    return view('mainhome');
});

// Login home route
Route::get('/login', function () {
    return view('loginhome');
});

Route::get('/race', function () {
    return view('viewrace');
});

Route::get('/race/seats', function () {
    return view('seatselection');
});

// Seller page route
Route::get('/sellerpage', function () {
    return view('sellerpage');
})->name('sellerpage'); // Named route: 'sellerpage'

Route::get('/race/new', function () {
    return view('createrace');
});

Route::post('/race/new', [RaceController::class, 'store']);

// Create Grandstand
Route::get('/grandstand/new', function () {
    return view('creategrandstand');
});

Route::post('/grandstand/new', [GrandstandController::class, 'store']);

