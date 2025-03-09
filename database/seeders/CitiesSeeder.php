<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['country' => 'Reino Unido', 'currency_name' => 'Libra esterlina', 'currency_symbol' => '£', 'currency_code' => 'GBP'],
            ['country' => 'New York', 'currency_name' => 'Dólar estadounidense', 'currency_symbol' => '$', 'currency_code' => 'USD'],
            ['country' => 'Francia', 'currency_name' => 'Euro', 'currency_symbol' => '€', 'currency_code' => 'EUR'],
            ['country' => 'Japón', 'currency_name' => 'Yen japonés', 'currency_symbol' => '¥', 'currency_code' => 'JPY'],
            ['country' => 'España', 'currency_name' => 'Euro', 'currency_symbol' => '€', 'currency_code' => 'EUR'],
        ]);        
    }
}
