<?php

use App\Http\Controllers\RaceController;
use App\Http\Controllers\GrandstandController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('races', RaceController::class);
    Route::resource('grandstand', GrandstandController::class);
    Route::resource('seat', SeatController::class);
    Route::resource('ticket', TicketController::class);
});