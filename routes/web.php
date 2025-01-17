<?php

use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/mainhome', function () {
    return view('mainhome');
});

Route::get('/user/{id}', function (string $id) {
    return new UserResource(User::findOrFail($id));
});
Route::get('/users', function () {
    return UserCollection::collection(User::all());
});