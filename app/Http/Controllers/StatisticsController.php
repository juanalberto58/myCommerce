<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SalesOrderLine;
use App\Models\Product;
use PDF;


class StatisticsController extends Controller
{

    // Funcion para mostrar la vista de inicio de estadisticas
    public function index()
    {
        $sales = Sale::all();
        $salesLines = SalesOrderLine::all();
        $products = Product::all();

        $salesJson = $sales->toJson();
        $salesLinesJson = $salesLines->toJson();
        $productsJson = $products->toJson();

        return view('statistics', compact('salesJson','productsJson','salesLinesJson'));
    }
    
    // Funcion para mostrar la vista de inicio de estadisticas
    public function store(Request $request)
    {
        return redirect()->route('statistics.index');
    }
}

?>
