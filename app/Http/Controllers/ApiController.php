<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ApiController extends Controller
{
    public function getCurrencyByCity($city) {
        // API de OpenWeather para obtener el país
        $apiKey = env('WEATHER_API_KEY');
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric&lang=es";
        
        $response = Http::get($url);
    
        if ($response->failed()) {
            return response()->json(['error' => 'Error al obtener la información de la ciudad'], 500);
        }
    
        $data = $response->json();
        $countryCode = $data['sys']['country'] ?? null;
    
        // Tabla de países con sus monedas y símbolos
        $currencies = [
            'US' => ['moneda' => 'Dólar estadounidense', 'simbolo' => '$', 'codigo' => 'USD'],
            'GB' => ['moneda' => 'Libra esterlina', 'simbolo' => '£', 'codigo' => 'GBP'],
            'JP' => ['moneda' => 'Yen japonés', 'simbolo' => '¥', 'codigo' => 'JPY'],
            'FR' => ['moneda' => 'Euro', 'simbolo' => '€', 'codigo' => 'EUR'],
            'ES' => ['moneda' => 'Euro', 'simbolo' => '€', 'codigo' => 'EUR'],
            'CO' => ['moneda' => 'Peso colombiano', 'simbolo' => '$', 'codigo' => 'COP'],
        ];
    
        if (!isset($currencies[$countryCode])) {
            return response()->json(['error' => 'No se encontró la moneda para esta ciudad'], 404);
        }
    
        return response()->json([
            'ciudad' => $data['name'],
            'pais' => $countryCode,
            'moneda' => $currencies[$countryCode]['moneda'],
            'simbolo' => $currencies[$countryCode]['simbolo'],
            'codigo' => $currencies[$countryCode]['codigo']
        ]);
    }
    
    
    

    public function getExchangeRateByCity($city, $amount) {
        // Obtener la moneda local según la ciudad
        $currencyResponse = $this->getCurrencyByCity($city);
    
        if ($currencyResponse->getStatusCode() !== 200) {
            return $currencyResponse; // Retornar el error si no se encuentra la moneda
        }
    
        $currencyData = $currencyResponse->getData();
        $currencyCode = $currencyData->codigo;
        $currencySymbol = $currencyData->simbolo;
    
        // API de conversión de moneda
        $apiKey = env('EXCHANGE_API_KEY');
        $url = "https://api.exchangeratesapi.io/latest?access_key={$apiKey}";
        
        
        $response = Http::get($url);
    
        if ($response->failed()) {
            return response()->json(['error' => 'Error al obtener la tasa de cambio'], 500);
        }
    
        $data = $response->json();
    
        if (!isset($data['conversion_rates'][$currencyCode])) {
            return response()->json(['error' => 'Moneda no encontrada'], 404);
        }
    
        $exchangeRate = $data['conversion_rates'][$currencyCode];
        $convertedAmount = round($amount * $exchangeRate, 2);
    
        return response()->json([
            'ciudad' => $city,
            'moneda_local' => $currencyData->moneda,
            'simbolo' => $currencySymbol,
            'tasa_cambio' => $exchangeRate,
            'presupuesto_cop' => $amount . ' COP',
            'monto_convertido' => $convertedAmount . " $currencySymbol"
        ]);
    }
}