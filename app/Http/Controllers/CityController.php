<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index() {
        $cities = City::all();
        return response()->json(City::select('country', 'currency_name', 'currency_symbol', 'currency_code')->get());

    }

    public function showTable() {
        $cities = City::all(); // Obtiene todas las ciudades
        return view('cities.index', compact('cities')); // Retorna la vista con los datos
    }
    
    

    public function create() {
        return view('cities.create');
    }

    public function store(Request $request) {
        $request->validate([
            'country' => 'required|string',
            'currency_name' => 'required|string',
            'currency_symbol' => 'required|string',
            'currency_code' => 'required|string',
        ]);

        City::create($request->all());

        return redirect()->route('cities.index')->with('success', 'Ciudad agregada exitosamente.');
    }
}
