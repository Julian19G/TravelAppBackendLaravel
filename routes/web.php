<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cities', function () {
    return response()->json(City::all());
});

Route::get('/weather/{city}', [ApiController::class, 'getWeather']);
Route::get('/exchange/{currency}', [ApiController::class, 'getExchangeRate']);
