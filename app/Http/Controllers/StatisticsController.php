<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;


class StatisticsController extends Controller
{

    // Funcion para mostrar la vista de inicio de estadisticas
    public function index()
    {
        $sales = Sale::all();
        $salesJson = $sales->toJson();
        return view('statistics', compact('salesJson'));
    }
    
    // Funcion para mostrar la vista de inicio de estadisticas
    public function store(Request $request)
    {
        return redirect()->route('statistics.index');
    }
}

?>
