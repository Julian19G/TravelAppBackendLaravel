<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    public function getWeather($city) {
        $apiKey = env('WEATHER_API_KEY');
        $url = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city&aqi=no";
        $response = Http::get($url);

        return $response->json();
    }

    public function getExchangeRate($currencyCode) {
        $apiKey = env('EXCHANGE_API_KEY');
        $url = "https://v6.exchangerate-api.com/v6/$apiKey/latest/COP";
        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Error al obtener la tasa de cambio'], 500);
        }

        $data = $response->json();

            // Verifica si la clave conversion_rates existe
    if (!isset($data['conversion_rates'][$currencyCode])) {
        return response()->json(['error' => 'Moneda no encontrada'], 404);
    }

    return response()->json([
        'currency' => $currencyCode,
        'exchange_rate' => $data['conversion_rates'][$currencyCode]
    ]);
    
    }
}
