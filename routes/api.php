<?php

use App\Http\Controllers\API\RaceController;
use App\Http\Controllers\API\GrandstandController;
use App\Http\Controllers\API\SeatController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

# USER ROUTES
Route::get('/users', [UserController::class, 'index']);
Route::post('/user/login', [UserController::class, 'check']);
Route::get('/user/{id}', [UserController::class, 'get']);
Route::post('/user', [UserController::class, 'add'])->middleware(['auth:sanctum']);

# RACE ROUTES
Route::get('/races', [RaceController::class, 'index']);
Route::get('/race/{id}', [RaceController::class, 'show']);
Route::post('/race', [RaceController::class, 'add'])->middleware(['auth:sanctum']);
Route::get('/race/delete/{id}', [RaceController::class, 'delete'])->middleware(['auth:sanctum']);

# GRANDSTAND ROUTES
Route::get('/race/{race}/grandstands', [GrandstandController::class, 'get_all_by_race']);
Route::get('/grandstand/{id}', [GrandstandController::class, 'get']);
Route::post('/grandstand', [GrandstandController::class, 'add'])->middleware(['auth:sanctum']);
Route::get('/grandstand/delete/{id}', [GrandstandController::class, 'delete'])->middleware(['auth:sanctum']);

# SEAT ROUTES
Route::get('/grandstand/{grandstand}/seats', [SeatController::class, 'get_all_by_grandstand']);
Route::get('/seat/{id}', [SeatController::class, 'get']);
Route::post('/seat', [SeatController::class, 'add'])->middleware(['auth:sanctum']);
Route::get('/seat/delete/{id}', [SeatController::class, 'delete'])->middleware(['auth:sanctum']);

# TICKET ROUTES

Route::get('/user/{id}/tickets', [TicketController::class, 'get_all_by_user']);
Route::get('/ticket/{id}', [TicketController::class, 'get']);
Route::post('/ticket', [TicketController::class, 'create'])->middleware(['auth:sanctum']);
Route::get('/ticket/delete/{id}', [TicketController::class, 'delete'])->middleware(['auth:sanctum']);