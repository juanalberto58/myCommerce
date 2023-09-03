<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use PDF;


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

public function generateSalesReport(Request $request)
{
    // Obtener las fechas de inicio y fin del formulario
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    // Obtener las ventas dentro del rango de fechas
    $sales = Sale::whereBetween('date', [$startDate, $endDate])->get();

    // Verificar si hay ventas para generar el informe
    if ($sales->isEmpty()) {
        return redirect()->route('statistics.index')->with('error', 'No hay ventas en el rango de fechas seleccionado.');
    }

    // Obtener los detalles de las líneas de pedido para estas ventas
    $salesDetails = [];
    foreach ($sales as $sale) {
        $details = SalesOrderLine::where('sale_id', $sale->id)->get();
        $salesDetails[$sale->id] = $details;
    }

    // Generar el PDF
    $pdf = PDF::loadView('sales_report', compact('sales', 'salesDetails'));

    // Descargar el PDF automáticamente
    return $pdf->download('sales_report.pdf');
}
}

?>
