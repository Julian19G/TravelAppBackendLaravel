<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CityController;
use App\Models\City;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
Route::get('/cities/table', [CityController::class, 'showTable'])->name('cities.table');

