<?php

use Illuminate\Support\Facades\Route;

Route::get('/mainhome', function () {
    return view('mainhome');
});
