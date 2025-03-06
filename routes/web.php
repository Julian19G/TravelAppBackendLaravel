<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CityController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
Route::post('/cities', [CityController::class, 'store'])->name('cities.store');

Route::get('/weather/{city}', [ApiController::class, 'getWeather'])
    ->where('city', '[A-Za-z\s]+') // Solo letras y espacios
    ->name('weather.show');

Route::get('/exchange/{city}', [ApiController::class, 'getExchange'])
    ->where('city', '^[A-Za-zÀ-ÿ\s]+$') // Permite letras con acentos y espacios
    ->name('exchange.show');
