<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CityController;



Route::get('/test', function () {
    return response()->json(['message' => 'API routes are working!']);
});

Route::get('/cities', [CityController::class, 'index']);
Route::post('/cities', [CityController::class, 'store'])->name('cities.store');

Route::get('/weather/{city}', [ApiController::class, 'getWeather'])
    ->where('city', '[A-Za-z\s]+') 
    ->name('weather.show');

Route::get('/exchange/{city}', [ApiController::class, 'getExchange'])
    ->where('city', '^[A-Za-zÀ-ÿ\s]+$') 
    ->name('exchange.show');

    Route::get('/api/weather/{city}', [CityApiController::class, 'getCityWeather']);
    Route::get('/api/exchange/{city}', [CityApiController::class, 'getCityExchangeRate']);
    