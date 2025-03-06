<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- Agregar esta línea
use Carbon\Carbon; // <-- Agregar esta línea

class ExchangeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exchangeRates = [
            ['currency_code' => 'USD', 'rate_to_cop' => 4000],
            ['currency_code' => 'EUR', 'rate_to_cop' => 4350],
            ['currency_code' => 'GBP', 'rate_to_cop' => 5050],
            ['currency_code' => 'MXN', 'rate_to_cop' => 220],
            ['currency_code' => 'ARS', 'rate_to_cop' => 9],
            ['currency_code' => 'BRL', 'rate_to_cop' => 750],
            ['currency_code' => 'CLP', 'rate_to_cop' => 5],
            ['currency_code' => 'JPY', 'rate_to_cop' => 30],
            ['currency_code' => 'CNY', 'rate_to_cop' => 570],
        ];

        foreach ($exchangeRates as $rate) {
            DB::table('exchange_rates')->insert([
                'currency_code' => $rate['currency_code'],
                'rate_to_cop' => $rate['rate_to_cop'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
