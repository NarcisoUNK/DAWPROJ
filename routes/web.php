<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;


// Main home route
Route::get('/', function () {
    return view('mainhome');
});

// Login home route
Route::get('/login', function () {
    return view('loginhome');
})->name('login');


Route::get('/viewrace', function () {
    return view('viewrace');
})->name('viewrace'); // Named route: 'viewrace'

Route::get('seatselection', function () {
    return view('seatselection');
})->name('seatselection');

// Seller page route
Route::get('/sellerpage', function () {
    return view('sellerpage');
})->name('sellerpage'); // Named route: 'sellerpage'

Route::get('/userpage', function () {
    return view('userpage');
})->name('userpage'); // Named route: 'userpage'


Route::get('/createrace', function () {
    return view('createrace');
});

Route::post('/store-race', [RaceController::class, 'store'])->name('store.race');

// Create Grandstand
Route::get('/creategrandstand', function () {
    return view('creategrandstand');
})->name('creategrandstand');

Route::post('/store-grandstand', [GrandstandController::class, 'store'])->name('store.grandstand');

