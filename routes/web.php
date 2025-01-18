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

Route::get('/viewrace', function () {
    return view('viewrace');
})->name('viewrace'); // Named route: 'loginhome'

// Seller page route
Route::get('/sellerpage', function () {
    return view('sellerpage');
})->name('sellerpage'); // Named route: 'sellerpage'

Route::get('/createrace', function () {
    return view('createrace');
})->name('createrace');

Route::post('/store-race', [RaceController::class, 'store'])->name('store.race');

// Create Grandstand
Route::get('/creategrandstand', function () {
    return view('creategrandstand');
})->name('creategrandstand');

Route::post('/store-grandstand', [GrandstandController::class, 'store'])->name('store.grandstand');

