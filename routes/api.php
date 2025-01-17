<?php

use App\Http\Controllers\API\RaceController;
use App\Http\Controllers\API\GrandstandController;
use App\Http\Controllers\API\SeatController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('races', RaceController::class);
    Route::resource('grandstand', GrandstandController::class);
    Route::resource('seat', SeatController::class);
    Route::resource('ticket', TicketController::class);
});