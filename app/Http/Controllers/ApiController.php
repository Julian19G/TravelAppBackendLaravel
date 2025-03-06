<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    public function getWeather($city)
    {
        $apiKey = env('WEATHER_API_KEY'); // Asegúrate de tener esta variable en .env
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=es";

        $response = Http::get($url);

        if (!$response->successful()) {
            return response()->json(['error' => 'No se pudo obtener información de la ciudad'], 500);
        }

        return response()->json($response->json());
    
    }
    
    
    public function getExchange($city)
    {
        $apiKey = env('EXCHANGE_API_KEY'); // Asegúrate de tener esta variable en .env
        $url = "https://api.exchangeratesapi.io/latest?access_key={$apiKey}";
    
        $response = Http::get($url);
    
        if (!$response->successful()) {
            return response()->json(['error' => 'No se pudo obtener la información de la tasa de cambio'], 500);
        }
    
        $data = $response->json();
    
        if (!isset($data['rates']['USD']) || !isset($data['rates']['COP'])) {
            return response()->json(['error' => 'No se encontraron tasas de cambio para COP o USD'], 500);
        }
    
        // Calcular la conversión de COP a USD
        $eurToCop = $data['rates']['COP']; // Cuántos COP equivalen a 1 EUR
        $eurToUsd = $data['rates']['USD']; // Cuántos USD equivalen a 1 EUR
    
        $copToUsd = $eurToUsd / $eurToCop; // Conversión de COP a USD
    
        return response()->json([
            'COP_to_USD' => $copToUsd,
            'rate_date' => $data['date']
        ]);
    }
    
    
   
}