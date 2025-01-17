<?php

use App\Http\Controllers\API\RaceController;
use App\Http\Controllers\API\GrandstandController;
use App\Http\Controllers\API\SeatController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

# USER ROUTES
Route::get('/users', [UserController::class, 'index']);
Route::get('/user/get/{id}', [UserController::class, 'get']);
Route::post('/user/add', [UserController::class, 'add']);

# RACE ROUTES
Route::get('/races', [RaceController::class, 'index']);
Route::get('/race/{id}', [RaceController::class, 'get']);
Route::get('/race', [RaceController::class, 'error'])->middleware(['auth:sanctum']);
Route::post('/race', [RaceController::class, 'add'])->middleware(['auth:sanctum']);
Route::get('/race/delete/{id}', [RaceController::class, 'delete'])->middleware(['auth:sanctum']);

# GRANDSTAND ROUTES
Route::get('/race/{race}/grandstands', [GrandstandController::class, 'get_all_by_race']);
Route::get('/grandstand/{id}', [GrandstandController::class, 'get']);
Route::get('/grandstand', [GrandstandController::class, 'error'])->middleware(['auth:sanctum']);
Route::post('/grandstand', [GrandstandController::class, 'add'])->middleware(['auth:sanctum']);
Route::get('/grandstand/delete/{id}', [GrandstandController::class, 'delete'])->middleware(['auth:sanctum']);

# SEAT ROUTES
Route::get('/grandstand/{grandstand}/seats', [SeatController::class, 'index']);
Route::get('/seat/{id}', [SeatController::class, 'get']);
Route::get('/seat', [SeatController::class, 'error'])->middleware(['auth:sanctum']);
Route::post('/seat', [SeatController::class, 'add'])->middleware(['auth:sanctum']);
Route::get('/seat/delete/{id}', [SeatController::class, 'delete'])->middleware(['auth:sanctum']);

# TICKET ROUTES
Route::get('/user/{id}/tickets', [TicketController::class, 'get_all_by_grandstand']);
Route::get('/ticket/{id}', [TicketController::class, 'get']);
Route::get('/ticket', [TicketController::class, 'error'])->middleware(['auth:sanctum']);
Route::post('/ticket', [TicketController::class, 'add'])->middleware(['auth:sanctum']);
Route::get('/ticket/delete/{id}', [TicketController::class, 'delete'])->middleware(['auth:sanctum']);
