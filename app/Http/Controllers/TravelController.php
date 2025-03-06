<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TravelController extends Controller
{
    public function getCities()
    {
        return response()->json([
            'cities' => ['Londres', 'New York', 'Paris', 'Tokyo', 'Madrid']
        ]);
    }

    public function getWeather($city)
    {
        $apiKey = env('WEATHER_API_KEY'); // Guarda tu clave en .env
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'No se pudo obtener el clima'], 500);
    }

    public function getExchangeRate($city, $amount)
    {
        // Mapeo de ciudades a monedas
        $currencyMap = [
            'Londres' => 'GBP',
            'New York' => 'USD',
            'Paris' => 'EUR',
            'Tokyo' => 'JPY',
            'Madrid' => 'EUR'
        ];

        $currency = $currencyMap[$city] ?? 'USD';
        $apiKey = env('EXCHANGE_API_KEY'); // Guarda tu clave en .env
        $url = "https://api.exchangerate-api.com/v4/latest/COP"; 

        $response = Http::get($url);

        if ($response->successful()) {
            $rates = $response->json()['rates'];
            $rate = $rates[$currency] ?? null;

            if ($rate) {
                return response()->json([
                    'currency' => $currency,
                    'symbol' => $this->getCurrencySymbol($currency),
                    'rate' => $rate,
                    'converted_amount' => $amount * $rate
                ]);
            }
        }

        return response()->json(['error' => 'No se pudo obtener la tasa de cambio'], 500);
    }

    private function getCurrencySymbol($currency)
    {
        $symbols = [
            'GBP' => '£',
            'USD' => '$',
            'EUR' => '€',
            'JPY' => '¥'
        ];

        return $symbols[$currency] ?? '$';
    }
}
