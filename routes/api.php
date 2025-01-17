<?php

use App\Http\Controllers\API\RaceController;
use App\Http\Controllers\API\GrandstandController;
use App\Http\Controllers\API\SeatController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\UserController;
use App\Models\Grandstand;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# USER ROUTES
Route::get('/users', [UserController::class, 'index']);
Route::get('/user/get/{id}', [UserController::class, 'get']);
Route::post('/user/add', [UserController::class, 'add']);

# RACE ROUTES
Route::get('/races', [RaceController::class, 'index']);
Route::get('/race/get/{id}', [RaceController::class, 'get']);
Route::post('/race/add', [RaceController::class, 'add']);
Route::get('/race/delete/{id}', [RaceController::class, 'delete']);

# GRANDSTAND ROUTES
Route::get('/{race}/grandstands', [GrandstandController::class, 'index']);
Route::get('/grandstand/get/{id}', [GrandstandController::class, 'get']);
Route::post('/grandstand/add', [GrandstandController::class, 'add']);
Route::get('/grandstand/delete/{id}', [GrandstandController::class, 'delete']);

# SEAT ROUTES
Route::get('/{race}/{grandstand}/seats', [SeatController::class, 'index']);
Route::get('/seat/get/{id}', [SeatController::class, 'get']);
Route::post('/seat/add', [SeatController::class, 'add']);
Route::get('/seat/delete/{id}', [SeatController::class, 'delete']);

# TICKET ROUTES
Route::get('/user/get/{id}/tickets', [TicketController::class, 'index']);
Route::get('/ticket/get/{id}', [TicketController::class, 'get']);
Route::post('/ticket/add', [TicketController::class, 'add']);
Route::get('/ticket/delete/{id}', [TicketController::class, 'delete']);
