<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;


class StatisticsController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        $salesJson = $sales->toJson();
        return view('statistics', compact('salesJson'));
    }
    


    public function store(Request $request)
    {
        return redirect()->route('statistics.index');
    }
}

?>
